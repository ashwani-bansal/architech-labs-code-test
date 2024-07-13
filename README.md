# Acme Widget Co - Basket System

## Overview
This PHP script implements a basket system for Acme Widget Co's sales system proof of concept. It allows adding products to a basket, calculating the total cost including delivery charges and applying special offers.

## Implementation Details
- **AcmeWidgetBasket Class**: Represents the basket system.
  - **Constructor**: Initializes with a product catalogue, delivery charge rules, and special offers.
  - **Methods**:
    - `add($productCode)`: Adds a product to the basket.
    - `total()`: Calculates the total cost of the basket including delivery charges and applying special offers.
  - **Special Offers**: Currently supports a single initial offer "buy one red widget, get the second half price".

## Example Usage
The script includes example usage demonstrating how to create baskets and calculate their totals based on the provided examples.

## Assumptions
- Products and their prices are defined in a `$catalogue` array.
- Delivery charge rules are defined in a `$deliveryRules` array.
- Special offers are defined in an `$offers` array.
- The script assumes valid input and does not handle errors like invalid product codes beyond basic checking.

