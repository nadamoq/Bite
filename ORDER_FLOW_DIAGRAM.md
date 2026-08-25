# Frontend Order Flow Diagram

## Complete Order Submission Flow

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                         USER INTERACTION FLOW                                │
└─────────────────────────────────────────────────────────────────────────────┘

1. USER ADDS ITEMS TO CART
   ┌────────────────────┐
   │  Browse Menu Items │
   └──────────┬─────────┘
              │
              ▼
   ┌────────────────────────────┐
   │  Click "Add to Cart" or    │
   │  "Quick Add" Button        │
   └──────────┬─────────────────┘
              │
              ▼
   ┌──────────────────────────────────────┐
   │  Cart Item Added:                    │
   │  {                                   │
   │    menuitem_id: 1,       ◄─── ID    │
   │    name: "Burger",                   │
   │    qty: 1,                           │
   │    total: 15.99,                     │
   │    addons: "Extra Cheese"            │
   │  }                                   │
   └──────────┬───────────────────────────┘
              │
              ▼
   ┌────────────────────────────────────────┐
   │  Cart Count Updated                    │
   │  Cart Modal Shows All Items            │
   │  Subtotal, Total Calculated            │
   └──────────┬─────────────────────────────┘
              │
              ▼
   ┌────────────────────────────────────┐
   │  User Reviews Cart & Continues     │
   │  Adding More Items OR              │
   │  Proceeds to Checkout              │
   └──────────┬────────────────────────┘
              │
              ▼


2. USER SUBMITS ORDER
   ┌──────────────────────────────────────────┐
   │  User Clicks "Complete Order" Button     │
   │  Button text: "Complete Order"           │
   │  Button state: ENABLED                   │
   └──────────┬───────────────────────────────┘
              │
              ▼
   ┌──────────────────────────────────────────┐
   │  VALIDATION CHECK                        │
   │  ✓ Cart not empty?                       │
   │  ✓ All items have menuitem_id?           │
   │  ✓ Quantities are valid?                 │
   └──────────┬───────────────────────────────┘
              │
              ├─── ❌ Empty Cart ───┐
              │                     │
              │                  [ERROR]
              │                  Show: "Cart is empty"
              │                  Keep: Cart open
              │                  
              ├─── ✅ Valid ───┐
              │                │
              ▼                ▼
   ┌──────────────────────────────────────────┐
   │  SET LOADING STATE                       │
   │  ✓ isLoading = true                      │
   │  ✓ Button text: "Processing..."          │
   │  ✓ Button disabled: true                 │
   │  ✓ Clear previous errors/messages        │
   └──────────┬───────────────────────────────┘
              │
              ▼


3. DATA TRANSFORMATION
   ┌──────────────────────────────────────────┐
   │  Frontend Cart Data                      │
   │  ┌────────────────────────────────────┐  │
   │  │ cart = [                           │  │
   │  │   {                                │  │
   │  │     menuitem_id: 1,                │  │
   │  │     name: "Burger",                │  │
   │  │     qty: 2,                        │  │
   │  │     total: 31.98,  (2 × 15.99)    │  │
   │  │     addons: "Cheese, Bacon"        │  │
   │  │   },                               │  │
   │  │   {                                │  │
   │  │     menuitem_id: 3,                │  │
   │  │     name: "Fries",                 │  │
   │  │     qty: 1,                        │  │
   │  │     total: 5.99,                   │  │
   │  │     addons: ""                     │  │
   │  │   }                                │  │
   │  │ ]                                  │  │
   │  └────────────────────────────────────┘  │
   └──────────┬───────────────────────────────┘
              │
              │ buildOrderItems() transforms to:
              ▼
   ┌──────────────────────────────────────────┐
   │  Backend Request Format                  │
   │  ┌────────────────────────────────────┐  │
   │  │ {                                  │  │
   │  │   items: [                         │  │
   │  │     {                              │  │
   │  │       menuitem_id: 1,              │  │
   │  │       quantity: 2,                 │  │
   │  │       unit_price: 15.99, (31.98÷2)│  │
   │  │       special_instructions:        │  │
   │  │         "Cheese, Bacon"            │  │
   │  │     },                             │  │
   │  │     {                              │  │
   │  │       menuitem_id: 3,              │  │
   │  │       quantity: 1,                 │  │
   │  │       unit_price: 5.99,            │  │
   │  │       special_instructions: null   │  │
   │  │     }                              │  │
   │  │   ]                                │  │
   │  │ }                                  │  │
   │  └────────────────────────────────────┘  │
   └──────────┬───────────────────────────────┘
              │
              ▼


4. API REQUEST
   ┌──────────────────────────────────────────┐
   │  AXIOS POST REQUEST                      │
   │  URL: /order                             │
   │  Method: POST                            │
   │  Headers: {                              │
   │    'X-CSRF-TOKEN': '...',                │
   │    'Content-Type': 'application/json',   │
   │    'Accept': 'application/json'          │
   │  }                                       │
   │  Body: { items: [...] }                  │
   └──────────┬───────────────────────────────┘
              │
              │ Network Request
              ▼
   ┌──────────────────────────────────────────┐
   │  BACKEND: OrderController@store()        │
   │  • Validate request data                 │
   │  • Create Order record                   │
   │  • Create OrderItem records              │
   │  • Return response                       │
   └──────────┬───────────────────────────────┘
              │
              ▼


5. RESPONSE HANDLING
   ┌──────────────────────────────────────────┐
   │  SERVER RESPONSE RECEIVED                │
   └──────────┬───────────────────────────────┘
              │
              ├──────── Status: 201 (Created) ────┐
              │                                   │
              │      ✅ SUCCESS PATH              │
              │                                   │
              ▼                                   │
   ┌─────────────────────────────────┐          │
   │ Response: {                     │          │
   │   message: "success",           │          │
   │   data: {                       │          │
   │     id: 1,                      │          │
   │     order_number: "ORD-ABC123", │          │
   │     status: "pending",          │          │
   │     items: [...]                │          │
   │   }                             │          │
   │ }                               │          │
   └──────────┬────────────────────┘          │
              │                               │
              ▼                               │
   ┌──────────────────────────────────────────────┐
   │  FRONTEND: Update State                     │
   │  ✓ orderSuccess = true                      │
   │  ✓ orderId = "ORD-ABC123"                    │
   │  ✓ isLoading = false                        │
   │  ✓ orderError = null                        │
   └──────────┬───────────────────────────────────┘
              │
              ▼
   ┌──────────────────────────────────────────────┐
   │  UPDATE UI                                   │
   │  • Show success message box                  │
   │  • Clear cart array: []                      │
   │  • Close cart modal                          │
   │  • Reset promo code                          │
   │  • Show order number to user                 │
   │  • Alert: "✓ Order #ORD-ABC123 received"    │
   └──────────┬───────────────────────────────────┘
              │
              ▼
   ┌──────────────────────────────────────────────┐
   │  AUTO-DISMISS (After 3 seconds)              │
   │  • Hide success message                      │
   │  • Reset orderSuccess to false               │
   │  • User can browse menu again                │
   └──────────────────────────────────────────────┘


6. ERROR HANDLING - VALIDATION ERROR (422)
   ┌──────────────────────────────────────────┐
   │  Response Status: 422 (Unprocessable)    │
   │  Response: {                             │
   │    message: "Invalid data",              │
   │    errors: {                             │
   │      "items.0.menuitem_id": [            │
   │        "Must exist in menu_items"        │
   │      ]                                   │
   │    }                                     │
   │  }                                       │
   └──────────┬───────────────────────────────┘
              │
              ▼
   ┌──────────────────────────────────────────┐
   │  Parse Validation Errors                 │
   │  Extract: "Must exist in menu_items"     │
   │  Set: orderError = error message         │
   │  Set: isLoading = false                  │
   └──────────┬───────────────────────────────┘
              │
              ▼
   ┌──────────────────────────────────────────┐
   │  SHOW ERROR TO USER                      │
   │  • Display red error box                 │
   │  • Show specific error message           │
   │  • Keep cart intact                      │
   │  • Keep cart modal open                  │
   │  • Show alert with error                 │
   │  • Button returns to normal              │
   └──────────┬───────────────────────────────┘
              │
              ▼
   ┌──────────────────────────────────────────┐
   │  USER CAN:                               │
   │  • Correct the items                     │
   │  • Try submitting again                  │
   │  • Remove problematic items              │
   │  • Close cart and browse more            │
   └──────────────────────────────────────────┘


7. ERROR HANDLING - NETWORK ERROR
   ┌──────────────────────────────────────────┐
   │  Network Error or Timeout                │
   │  (No response from server)               │
   └──────────┬───────────────────────────────┘
              │
              ▼
   ┌──────────────────────────────────────────┐
   │  Catch Block                             │
   │  Set: orderError =                       │
   │    "Error processing order.              │
   │     Please try again."                   │
   │  Set: isLoading = false                  │
   └──────────┬───────────────────────────────┘
              │
              ▼
   ┌──────────────────────────────────────────┐
   │  SHOW ERROR TO USER                      │
   │  • Display red error box                 │
   │  • Show user-friendly message            │
   │  • Keep cart intact                      │
   │  • Allow retry                           │
   │  • Show alert with error                 │
   └──────────────────────────────────────────┘


STATE DIAGRAM
═════════════════════════════════════════════════════════════════

                           INITIAL STATE
                         cart = []
                    isLoading = false
                    orderError = null
                    orderSuccess = false
                              │
                              ▼
                    ┌─────────────────┐
                    │  Add Items to   │
                    │      Cart       │
                    └────────┬────────┘
                             │
                             ▼
                    ┌──────────────────┐
                    │  Click Checkout  │
                    │  Button          │
                    └────────┬─────────┘
                             │
                   ┌─────────┴─────────┐
                   │                   │
                   ▼                   ▼
            EMPTY CART          isLoading = true
            Show Error          orderError = null
                                  (Processing)
                                   │
                                   ▼
                              POST /order
                                   │
                    ┌──────────────┬┴───────────────┐
                    │              │                │
                   201           422              500+
                 SUCCESS        VALIDATION        OTHER
                    │            ERROR            ERROR
                    │              │                │
                    ▼              ▼                ▼
            orderSuccess=true   orderError=      orderError=
            orderId=ABC123      "validation      "network error"
            Clear cart         messages"        isLoading=false
            Close modal        Keep cart
            isLoading=false    isLoading=false
                    │              │                │
                    └──────────┬───┴────────────────┘
                               │
                               ▼
                         Show Message
                         Enable Retry
                              │
                              ▼
                         After 3 Sec
                      (Success only)
                        Dismiss
                        Message


DATA FLOW SUMMARY
═════════════════════════════════════════════════════════════════

Frontend                          Backend              Database
─────────────────────────────────────────────────────────────────

┌──────────────┐
│  Menu Items  │  ────GET───→  ┌────────────┐
│  (Frontend)  │               │ Controller │
└──────────────┘               │  (Fetch)   │
                               └──────┬─────┘
                                      │
                                      ▼
                               ┌─────────────┐
                               │ menu_items  │
                               │   table     │
                               └─────────────┘

┌──────────────┐
│  Shopping    │
│  Cart        │  ────POST──→  ┌────────────┐
│  (Frontend)  │  with items   │ Controller │
└──────────────┘               │  (Create)  │
                               └──────┬─────┘
                                      │
                    ┌─────────────────┼──────────────┐
                    │                 │              │
                    ▼                 ▼              ▼
                ┌────────┐      ┌───────────┐  ┌──────────────┐
                │ Orders │      │ OrderItem │  │ menu_items   │
                │ table  │      │  table    │  │ (validate)   │
                └────────┘      └───────────┘  └──────────────┘

┌──────────────┐
│  Response    │  ←───201───  ┌────────────┐
│  (Order #)   │  (Success)   │ Controller │
└──────────────┘  ←───422───  │ (Respond)  │
                  (Validation) └────────────┘
