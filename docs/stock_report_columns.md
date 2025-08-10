# Stock Report Table Columns Documentation

## Main Table Columns

1. **Product ID**
   - Description: Unique identifier for each product
   - Source: `products.id`
   - Type: Integer
   - Example: 1001

2. **Product Name**
   - Description: Name/title of the product
   - Source: `products.name`
   - Type: String
   - Example: "Paper A4"

3. **Category**
   - Description: Product category classification
   - Source: `categories.name`
   - Type: String
   - Default: "Uncategorized"
   - Example: "Office Supplies"

4. **Warehouse**
   - Description: Location where the product is stored
   - Source: `stores.name`
   - Type: String
   - Default: "Unassigned"
   - Example: "Main Warehouse"

5. **Stock Level**
   - Description: Current quantity of product in stock
   - Calculation: `total_purchased - total_sold`
   - Type: Number with unit
   - Formula: `SUM(purchases.qty) - SUM(orders_item.qty)`
   - Example: "500 units"

6. **Total Purchased**
   - Description: Total quantity ever purchased
   - Source: `SUM(purchases.qty)`
   - Type: Number
   - Example: 1000

7. **Sales**
   - Description: Total quantity sold
   - Source: `SUM(orders_item.qty)`
   - Type: Number
   - Example: 500

8. **Purchase Value (TZS)**
   - Description: Total money spent on purchasing this product
   - Source: `SUM(purchases.total_amount)`
   - Type: Decimal (2 places)
   - Currency: Tanzanian Shillings (TZS)
   - Example: 1,500,000.00

9. **Current Value (TZS)**
   - Description: Current value of remaining stock
   - Calculation: `current_stock * current_price`
   - Type: Decimal (2 places)
   - Formula: `quantity * price`
   - Currency: Tanzanian Shillings (TZS)
   - Example: 750,000.00

10. **Status**
    - Description: Current stock status indicator
    - Type: Label
    - Values:
      - "Out of Stock" (Red) - When quantity <= 0
      - "Low Stock" (Yellow) - When 0 < quantity <= 10
      - "In Stock" (Green) - When quantity > 10

## Summary Statistics

### Totals Row
- Shows aggregate values for the entire table
- Calculated for columns:
  - Stock Level: Sum of all stock quantities
  - Total Purchased: Sum of all purchases
  - Sales: Sum of all sales
  - Purchase Value: Total purchase value across all products
  - Current Value: Total current value of all stock

### Info Boxes
1. **Total Items**
   - Description: Number of unique products in inventory
   - Calculation: `COUNT(DISTINCT products.id)`

2. **Total Value**
   - Description: Total current value of all inventory
   - Calculation: `SUM(quantity * price)` for all products

3. **Low Stock Items**
   - Description: Count of products with low stock
   - Calculation: Count of products where 0 < quantity <= 10

4. **Out of Stock**
   - Description: Count of products with zero stock
   - Calculation: Count of products where quantity <= 0

## Filters

1. **Category Filter**
   - Filters products by their category
   - Source: `categories.id`

2. **Warehouse Filter**
   - Filters products by their storage location
   - Source: `stores.id`

3. **Stock Status Filter**
   - Options:
     - All: Shows all products
     - In Stock: Shows products with quantity > 10
     - Low Stock: Shows products with 0 < quantity <= 10
     - Out of Stock: Shows products with quantity <= 0

## Notes

- All monetary values are displayed in Tanzanian Shillings (TZS)
- Quantities are shown with their respective units (e.g., pieces, boxes)
- Stock status is automatically updated based on current quantity
- All calculations consider only paid orders (`orders.paid_status = 1`)
- Null values are handled gracefully and displayed as 0 or appropriate defaults
