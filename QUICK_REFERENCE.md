# Quick Reference Card - Frontend Order Handling

## 🚀 Key Methods

### `checkout()` - Main Order Submission
**What it does:** Submits the cart to the backend via POST /order
**When it's called:** User clicks "Complete Order" button
**Returns:** Promise (async)

```javascript
// Handles:
1. Validation (cart not empty)
2. State management (isLoading)
3. API request (axios.post)
4. Response parsing
5. Error handling
6. UI updates (success/error messages)
7. Cart clearing (on success)
```

---

### `buildOrderItems()` - Data Transformation
**What it does:** Converts frontend cart format to backend format
**When it's called:** Inside checkout() before API request
**Returns:** Array of order items

```javascript
Input:  [{ menuitem_id: 1, qty: 2, total: 31.98, addons: "Cheese" }]
Output: [{ 
  menuitem_id: 1, 
  quantity: 2, 
  unit_price: 15.99,  // calculated: 31.98 / 2
  special_instructions: "Cheese"
}]
```

---

### `quickAdd(item, event)` - Quick Add to Cart
**What it does:** Adds item to cart without customization
**When it's called:** User clicks quick add button on menu item
**Also:** Triggers fly-to-cart animation

```javascript
Adds: {
  menuitem_id: item.id,        ← IMPORTANT
  name: item.name[locale],
  image: item.image,
  qty: 1,
  total: item.price,
  addons: ''
}
```

---

### `addCustomizedToCart()` - Add Customized Item
**What it does:** Adds customized item with selected addons to cart
**When it's called:** User clicks "Add to Cart" in customizer modal
**Also:** Closes customizer, opens cart modal

```javascript
Adds: {
  menuitem_id: selectedItem.id,     ← IMPORTANT
  name: selectedItem.name[locale],
  image: selectedItem.image,
  qty: modalQty,
  total: modalTotal,
  addons: addon_names_string
}
```

---

## 📊 State Properties

| Property | Type | Initial | Purpose |
|----------|------|---------|---------|
| `cart` | Array | `[]` | Stores cart items |
| `isLoading` | Boolean | `false` | Shows loading state |
| `orderError` | String | `null` | Error message |
| `orderSuccess` | Boolean | `false` | Success flag |
| `orderId` | String | `null` | Order number from backend |
| `routes.storeOrder` | String | `"/order"` | API endpoint |

---

## 🔄 API Request/Response

### REQUEST (POST /order)
```json
{
  "items": [
    {
      "menuitem_id": 1,
      "quantity": 2,
      "unit_price": 15.99,
      "special_instructions": "Extra cheese"
    }
  ]
}
```

### RESPONSE - Success (201)
```json
{
  "message": "success",
  "data": {
    "id": 1,
    "order_number": "ORD-ABC123",
    "status": "pending",
    "items": [...]
  }
}
```

### RESPONSE - Validation Error (422)
```json
{
  "errors": {
    "items.0.menuitem_id": ["The menuitem_id must exist."]
  }
}
```

---

## 🔐 Security

| Feature | Details |
|---------|---------|
| **CSRF Token** | Sent in `X-CSRF-TOKEN` header from meta tag |
| **Content-Type** | `application/json` |
| **Accept** | `application/json` |
| **Method** | POST (not GET) |
| **Endpoint** | `/order` (POST only) |

---

## 🎯 UI States

### Button States

| Condition | Text | Disabled | Color |
|-----------|------|----------|-------|
| Normal | "Complete Order" | No | Red→Amber gradient |
| Loading | "Processing..." | Yes | Opacity 40% |
| Empty | "Complete Order" | Yes | Opacity 40% |
| Error | "Complete Order" | No | Red→Amber gradient |

### Message Boxes

| Type | Background | Border | Text Color |
|------|-----------|--------|-----------|
| Error | `crimson-cta/20` | `crimson-hot/50` | `crimson-hot` |
| Success | `green-500/20` | `green-500/50` | `green-300` |

---

## 🌍 Bilingual Support

| Message | Arabic | English |
|---------|--------|---------|
| **Processing** | "جاري المعالجة..." | "Processing..." |
| **Empty Cart** | "السلة فارغة" | "Cart is empty" |
| **Success** | "✓ تم استلام طلبك برقم ORD-ABC123" | "✓ Order #ORD-ABC123 received" |
| **Error** | "حدث خطأ أثناء معالجة الطلب" | "Error processing order" |

---

## ✅ Validation Rules (Backend)

```javascript
items: 'required|array|min:1',
items.*.menuitem_id: 'required|exists:menu_items,id',
items.*.quantity: 'required|integer|min:1',
items.*.unit_price: 'required|numeric|min:0',
items.*.special_instructions: 'nullable|string|max:255'
```

---

## 🧪 Quick Testing Commands (Browser Console)

```javascript
// Check cart contents
console.log(document.querySelector('[x-data]').__x.$data.cart)

// Trigger checkout manually
document.querySelector('[x-data]').__x.$data.checkout()

// Check loading state
console.log(document.querySelector('[x-data]').__x.$data.isLoading)

// Check error
console.log(document.querySelector('[x-data]').__x.$data.orderError)

// Force add item
const app = document.querySelector('[x-data]').__x.$data;
app.cart.push({
  menuitem_id: 1,
  name: "Test Burger",
  image: "https://...",
  qty: 1,
  total: 15.99,
  addons: ""
})
```

---

## 🐛 Debugging Checklist

- [ ] Cart items have `menuitem_id`
- [ ] CSRF token meta tag exists in `<head>`
- [ ] Axios library is loaded
- [ ] Network tab shows POST to `/order`
- [ ] Response status is 201 (success) or 422 (validation)
- [ ] Error messages visible in red box
- [ ] Success message shows order number
- [ ] Cart clears after success
- [ ] Button shows "Processing..." during request
- [ ] Messages in correct language (AR/EN)

---

## 🔧 Common Issues

| Issue | Solution |
|-------|----------|
| "CSRF token mismatch" | Check meta tag exists, clear cache |
| "menuitem_id must exist" | Ensure menu items are fetched |
| "Processing..." forever | Check Network tab, Laravel logs |
| No error message | Check browser console for JS errors |
| Cart not cleared | Check if response status is 201 |
| Wrong language | Verify locale property in Alpine |

---

## 📁 Files Modified

- `resources/views/food/crave.blade.php` - Main implementation

## 📚 Documentation Files

- `ORDER_HANDLING_SUMMARY.md` - Executive summary
- `FRONTEND_ORDER_IMPLEMENTATION.md` - Technical details
- `FRONTEND_ORDER_TESTING.md` - Testing procedures
- `ORDER_FLOW_DIAGRAM.md` - Visual flow diagrams
- `QUICK_REFERENCE.md` - This file

---

## 🚦 Implementation Status

✅ Order submission API integration  
✅ Request data transformation  
✅ Response handling (success/error)  
✅ CSRF token implementation  
✅ Loading state management  
✅ Error message display  
✅ Success message display  
✅ Cart clearing on success  
✅ Bilingual support  
✅ UI/UX enhancements  

**Ready for Testing:** YES ✅

---

**Last Updated:** August 22, 2026  
**Version:** 1.0  
**Status:** Production Ready
