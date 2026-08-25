# Frontend Order Handling - Testing Guide

## Quick Start Testing

### 1. Test with Browser Console
Open the browser DevTools (F12) and test the order data structure:

```javascript
// Check current cart
console.log(craveApp().cart);

// Simulate adding items (in console)
// The app will build this when you add items through the UI

// Expected cart structure:
[
  {
    menuitem_id: 1,
    name: "Double Beast Burger",
    image: "https://...",
    qty: 2,
    total: 31.98,
    addons: "Extra Cheese, Crispy Bacon"
  },
  {
    menuitem_id: 3,
    name: "French Fries",
    image: "https://...",
    qty: 1,
    total: 5.99,
    addons: ""
  }
]
```

### 2. Test Order Request Format
The checkout function sends this exact format to `/order` endpoint:

```javascript
{
  items: [
    {
      menuitem_id: 1,
      quantity: 2,
      unit_price: 15.99,
      special_instructions: "Extra Cheese, Crispy Bacon"
    },
    {
      menuitem_id: 3,
      quantity: 1,
      unit_price: 5.99,
      special_instructions: null
    }
  ]
}
```

### 3. Expected Backend Response (Success)
When order is created successfully, backend returns:

```json
{
  "message": "success",
  "data": {
    "id": 1,
    "order_number": "ORD-ABC123",
    "order_type": "delivery",
    "user_id": 1,
    "status": "pending",
    "total_price": null,
    "created_at": "2026-08-22T10:30:00.000000Z",
    "updated_at": "2026-08-22T10:30:00.000000Z",
    "items": [
      {
        "id": 1,
        "order_id": 1,
        "menuitem_id": 1,
        "quantity": 2,
        "unit_price": 15.99,
        "total_price": 31.98,
        "special_instructions": "Extra Cheese, Crispy Bacon",
        "created_at": "2026-08-22T10:30:00.000000Z",
        "updated_at": "2026-08-22T10:30:00.000000Z"
      },
      {
        "id": 2,
        "order_id": 1,
        "menuitem_id": 3,
        "quantity": 1,
        "unit_price": 5.99,
        "total_price": 5.99,
        "special_instructions": null,
        "created_at": "2026-08-22T10:30:00.000000Z",
        "updated_at": "2026-08-22T10:30:00.000000Z"
      }
    ]
  }
}
```

### 4. Expected Backend Response (Validation Error)
If validation fails, backend returns:

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "items": ["The items field is required."],
    "items.0.menuitem_id": ["The items.0.menuitem_id must exist in menu_items table."],
    "items.0.quantity": ["The items.0.quantity must be at least 1."]
  }
}
```

## Manual Testing Steps

### Test 1: Add Single Item to Cart
1. Open Crave Kitchen frontend
2. Click on any menu item (e.g., "Double Beast Burger")
3. Click "Quick Add" or customize and add
4. Verify cart count increases
5. Open cart (click cart icon)
6. Verify item appears with correct name and price

### Test 2: Add Customized Item
1. Click on a menu item
2. Click the item card to open customizer
3. Select some addons
4. Set quantity to 2
5. Click "Add to Cart"
6. Open cart
7. Verify customized item shows addons in cart

### Test 3: Submit Order Successfully
1. Add 1-3 items to cart
2. Click "Complete Order" button
3. **Expected Result:**
   - Button shows "Processing..." state
   - Order submitted to backend
   - Success message appears with Order Number
   - Cart is cleared
   - Modal closes automatically
   - Order number is displayed (e.g., "✓ Order #ORD-ABC123 received")

### Test 4: Test with Empty Cart
1. Clear the cart (remove all items)
2. Try to click "Complete Order"
3. **Expected Result:**
   - Button is disabled (grayed out)
   - Cannot submit order

### Test 5: Test CSRF Token
1. Check browser DevTools → Network tab
2. Click "Complete Order"
3. **Expected Result in Request Headers:**
   ```
   X-CSRF-TOKEN: eyJpdiI6IjAwMDAwMDAwMDAwMDAwMDAiLCJ2YWx1ZSI6IjAwMDAwMDAwMDAwMDAwMDAiLCJtYWMiOiIwMDAwMDAwMDAwMDAwMDAifQ==
   Content-Type: application/json
   Accept: application/json
   ```

### Test 6: Test Error Handling
To simulate an error, temporarily change the route to an invalid endpoint:
```javascript
// In browser console
app = craveApp()
app.routes.storeOrder = "/invalid-endpoint"
// Now try to submit order
```

**Expected Result:**
- Error message displayed in red box
- "❌ Error processing order" message shown
- Loading state clears
- User can try submitting again

### Test 7: Test Bilingual Messages

#### Switch to English
1. Click language toggle button
2. Add item to cart
3. Try submitting order
4. **Expected:** All messages appear in English

#### Switch to Arabic
1. Click language toggle button
2. Add item to cart
3. Try submitting order
4. **Expected:** All messages appear in Arabic
- Success: "✓ تم استلام طلبك برقم ORD-ABC123"
- Error: "حدث خطأ أثناء معالجة الطلب"

## Frontend Console Debugging

### Monitor Cart Changes
```javascript
// In browser console, run this:
const app = window.craveApp || document.querySelector('[x-data]').__x;
console.log("Cart:", app.cart);
console.log("Cart Count:", app.cartCount);
console.log("Cart Total:", app.cartTotal);
console.log("Order Items for Backend:", app.buildOrderItems());
```

### Check Loading State
```javascript
console.log("Is Loading:", app.isLoading);
console.log("Order Error:", app.orderError);
console.log("Order Success:", app.orderSuccess);
console.log("Order ID:", app.orderId);
```

### Manually Trigger Checkout
```javascript
app.checkout();
// Watch the console for any errors
```

## Network Inspection

### Via Browser DevTools

1. Open DevTools (F12)
2. Go to **Network** tab
3. Filter by "order" to see requests
4. Look for POST request to `/order`
5. Click the request to see:
   - **Headers:** CSRF token, Content-Type
   - **Payload:** Request body with items array
   - **Response:** Server response with order details

### Via PHP/Laravel

```bash
# In terminal, watch Laravel logs
tail -f storage/logs/laravel.log

# You should see order creation logging
```

## Common Issues & Solutions

### Issue: "CSRF token mismatch" Error
**Cause:** CSRF token not being sent with request
**Solution:**
1. Ensure meta tag exists: `<meta name="csrf-token" content="{{ csrf_token() }}">`
2. Clear browser cache
3. Restart browser

### Issue: "menuitem_id does not exist" Error
**Cause:** Menu items not loaded or IDs are incorrect
**Solution:**
1. Ensure menu items are fetched via `/menuitem` endpoint
2. Check that item IDs match what's in menu_items table
3. Verify fetchMenuData() runs on init

### Issue: Cart items don't have menuitem_id
**Cause:** Items added before update, or old code
**Solution:**
1. Clear browser localStorage
2. Hard refresh (Ctrl+Shift+R)
3. Add items again

### Issue: Button shows "Processing..." forever
**Cause:** Backend not responding or network issue
**Solution:**
1. Check browser Network tab for request
2. Check Laravel logs for errors
3. Ensure OrderController::store() is working
4. Check database connection

### Issue: Order disappears but success message doesn't show
**Cause:** Response format different than expected
**Solution:**
1. Check backend response JSON format
2. Ensure response.data.message === "success"
3. Ensure response.data.data.order_number exists

## Performance Testing

### Test Order Submission Speed
1. Open DevTools → Performance tab
2. Add items to cart
3. Click "Complete Order"
4. **Expected:** Request completes in <500ms
5. **Warning:** If >1000ms, check database queries

### Monitor Memory Usage
1. Open DevTools → Memory tab
2. Take heap snapshot before order
3. Submit order
4. Take heap snapshot after
5. **Expected:** No significant increase

## Security Verification

### CSRF Protection
- [x] Meta tag with CSRF token present
- [x] Token included in axios headers
- [x] POST request to /order route protected

### Input Validation
- [x] menuitem_id validated on backend
- [x] quantity validated (minimum 1)
- [x] unit_price validated (numeric)
- [x] special_instructions optional (max 255 chars)

### XSS Prevention
- [x] Error messages HTML-escaped in Alpine
- [x] Order number from server, not user input
- [x] No direct innerHTML usage

## Checklist for Production

- [ ] All items have valid menuitem_id
- [ ] CSRF token meta tag is in place
- [ ] Axios is included in page
- [ ] OrderController route is registered
- [ ] Database order/orderitem tables exist
- [ ] Error messages display correctly
- [ ] Loading state works properly
- [ ] Success message shows order number
- [ ] Cart clears after successful order
- [ ] Bilingual messages work in both locales
