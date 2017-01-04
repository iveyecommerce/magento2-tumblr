# magento2-tumblr

## About
Magento 2 extension which allows to display post from tumblr on your store pages.

## How to install

1. Add the following code to your magento 2 package.json
```json
{
    "repositories": [
        {
            "url": "https://github.com/iveyecommerce/magento2-tumblr.git",
            "type": "git"
        }
    ],
    "require": {
        "ivey/magento2-tumblr": "*"
    }
}
```
2. Execute following commands
```bash
  composer update
  bin/magento cache:clean
  bin/magento module:enable Ivey_Tumblr
  bin/magento 
```
