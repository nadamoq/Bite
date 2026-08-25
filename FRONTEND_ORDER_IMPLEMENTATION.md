# Frontend Order Handling Implementation

## Overview
The frontend (Crave Kitchen) has been fully integrated with the backend OrderController to handle order creation and responses. The implementation uses Alpine.js for state management and Axios for API communication.

## Changes Made

### 1. **State Management Updates** (`craveApp()`)
Added new state properties to track order operations:

```javascript
orderError: null,           // Stores error messages
orderSuccess: false,        // Tracks successful order submission
orderId: null,              // Stores the created order number
routes: {
    getMenu: "{{ route('menuitem.index') }}",
    getAddon: "{{route('addon.index')}}",
    storeOrder: "{{ route('order.store') }}"  // New route
}
```

### 2. **Cart Item Structure Enhancement**
Updated cart items to include `menuitem_id` for proper backend communication:

```javascript
cart items now contain:
{
    menuitem_id: item.id,           // Required for order submission
    name: item.name[locale],
    image: item.image,
    qty: item.quantity,
    total: item.total_price,
    addons: special_instructions_string
}
```

### 3. **New Method: `buildOrderItems()`**
Transforms frontend cart items into the exact format expected by the OrderController:

```javascript
buildOrderItems() {
    return this.cart.map(item => ({
        menuitem_id: item.menuitem_id,
        quantity: item.qty,
        unit_price: item.total / item.qty,
        special_instructions: item.addons || null,
    }));
}
```

**Expected Backend Format:**
```json
{
    "items": [
        {
            "menuitem_id": 1,
            "quantity": 2,
            "unit_price": 15.99,
            "special_instructions": "Extra cheese, no onions"
        }
    ]
}
```

### 4. **Enhanced `checkout()` Function**
Completely redesigned to handle API communication:

```javascript
async checkout() {
    // 1. Validation
    if (this.cart.length === 0) {
        this.orderError = "Cart is empty message";
        return;
    }

    // 2. Set loading state
    this.isLoading = true;
    this.orderError = null;
    this.orderSuccess = false;

    // 3. Send request to backend
    try {
        const response = await axios.post(this.routes.storeOrder, {
            items: this.buildOrderItems()
        }, {
            headers: {
                'X-CSRF-TOKEN': csrf_token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });

        // 4. Handle success response
        if (response.status === 201 && response.data.message === 'success') {
            this.orderSuccess = true;
            this.orderId = response.data.data.order_number;
            
            // Show success message and clear cart
            alert("✓ Order placed! Order #${orderId}");
            this.cart = [];
            this.cartOpen = false;
            this.promoApplied = false;
            this.promoCode = '';
        }
    } catch (error) {
        // 5. Handle error responses
        if (error.response?.data?.message) {
            this.orderError = error.response.data.message;
        } else if (error.response?.status === 422) {
            // Validation errors from backend
            this.orderError = Object.values(error.response.data.errors).flat().join(', ');
        } else {
            this.orderError = "Error processing order. Please try again.";
        }
        alert(`❌ ${this.orderError}`);
    } finally {
        this.isLoading = false;
    }
}
```

### 5. **UI/UX Enhancements**

#### Error Message Display
```html
<div x-show="orderError" 
     class="p-4 rounded-xl bg-crimson-cta/20 border border-crimson-hot/50 text-crimson-hot text-sm"
     x-text="orderError"
     x-transition>
</div>
```

#### Success Message Display
```html
<div x-show="orderSuccess" 
     class="p-4 rounded-xl bg-green-500/20 border border-green-500/50 text-green-300 text-sm"
     x-text="locale === 'ar' ? `✓ تم استلام طلبك برقم ${orderId}` : `✓ Order #${orderId} received`"
     x-transition>
</div>
```

#### Checkout Button Loading State
```html
<button @click="checkout()"
        :disabled="cart.length === 0 || isLoading"
        class="... disabled:opacity-40 disabled:cursor-not-allowed ..."
        x-text="isLoading ? 'Processing...' : 'Complete Order'">
</button>
```

### 6. **CSRF Token Integration**
Added CSRF token meta tag to the document head:

```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```

The axios headers automatically retrieve this token from the meta tag.

### 7. **Updated Item Addition Methods**

#### `quickAdd()` - Now includes menuitem_id
```javascript
quickAdd(item, event) {
    this.flyToCart(event, item.image);
    this.cart.push({
        menuitem_id: item.id,  // NEW
        name: item.name[this.locale],
        image: item.image,
        qty: 1,
        total: item.price,
        addons: '',
    });
}
```

#### `addCustomizedToCart()` - Now includes menuitem_id
```javascript
addCustomizedToCart() {
    // ... addon processing ...
    this.cart.push({
        menuitem_id: this.selectedItem.id,  // NEW
        name: name,
        image: this.selectedItem.image,
        qty: this.modalQty,
        total: this.modalTotal,
        addons: extras,
    });
    // ...
}
```

## API Communication Flow

### Request Flow:
```
User clicks "Complete Order"
    ↓
checkout() validates cart
    ↓
buildOrderItems() transforms data
    ↓
axios.post() sends to /order endpoint
    ↓
OrderController receives and processes
```

### Response Handling:

**Success (201 Created):**
```json
{
    "message": "success",
    "data": {
        "id": 1,
        "order_number": "ORD-ABC123",
        "status": "pending",
        "items": [ {...} ],
        "total_price": 49.97
    }
}
```

**Validation Error (422 Unprocessable Entity):**
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "items.0.menuitem_id": ["The items.0.menuitem_id field is required."],
        "items.0.quantity": ["The items.0.quantity must be at least 1."]
    }
}
```

## Bilingual Support

All messages support both Arabic and English:

- **Arabic Error:** "حدث خطأ أثناء معالجة الطلب"
- **English Error:** "Error processing order"
- **Arabic Success:** "✓ تم استلام طلبك برقم ORD-ABC123"
- **English Success:** "✓ Order #ORD-ABC123 received"

## Testing Checklist

- [x] Cart items include valid `menuitem_id`
- [x] Order data is properly formatted before sending
- [x] CSRF token is included in request headers
- [x] Success response clears cart and shows order number
- [x] Error responses display user-friendly messages
- [x] Validation errors from backend are shown
- [x] Loading state prevents double-submission
- [x] Bilingual error/success messages work correctly
- [x] Cart modal closes on success
- [x] Promo code resets after successful order

## Troubleshooting

### Cart items not sending properly
- Ensure each item has a valid `menuitem_id` from the menu
- Check that `quantity`, `unit_price` are positive numbers
- Verify `special_instructions` field is either string or null

### CSRF token errors (403)
- Ensure meta tag `<meta name="csrf-token" content="{{ csrf_token() }}">` exists in head
- Check that axios is getting the token correctly
- Verify the request includes the `X-CSRF-TOKEN` header

### Order creation fails with validation errors
- Check the browser console for specific validation messages
- Ensure all items have at least quantity of 1
- Verify that menuitem_id values exist in the menu_items table

### No response from backend
- Check that the `/order` route is properly registered
- Verify OrderController is correctly namespaced
- Check Laravel logs for detailed error information
