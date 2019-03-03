# Ccastro_Frenet Module

The Ccastro_Frenet module provides integration with the Frenet shipping carrier.


## Description

The module integrates Frenet shipping carrier into Magento 2.

## Getting Started

The following steps are required to configure the Frenet module.

### Activate Magento Shipping

A Frenet account must be created at the [Frenet](https://painel.frenet.com.br/public/step0.aspx) in order to get the token and use the extension.

### Configure

Registration provides you with an API endpoint and API credentials to configure the extension. Enter these into the _Frenet_ section of the the _Shipping Methods_ configuration page, which is located at:

```
Stores → Configuration → Sales → Shipping Methods
```

Complete the following configuration below the main _Frenet_ configuration section:

1. Key: Key from dashboard.
1. Password: Password from dashboard.
1. Token: Token from dashboard.
1. Add extra days to delivery date: number of days to be added to the shipping delivery time
1. Default Dimensional Height: Value to be used if height is not defined in product.
1. Default Dimensional Length: Value to be used if length is not defined in product.
1. Default Dimensional Width: Value to be used if width is not defined in product.
1. Shipping days message: Shipping method description

After the configuration is complete, enable Frenet for checkout using the following drop-down setting in the main _Frenet_ configuration section:

```
Stores → Configuration → Sales → Shipping Methods → Frenet → Enabled: Yes
```

## Technical Information

Product attributes created:
1. frenet_dimensions_length
1. frenet_dimensions_height
1. frenet_dimensions_width
1. frenet_dimensions_diameter
1. frenet_dimensions_is_fragile

