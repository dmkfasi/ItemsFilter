### You are given an Item Entity and an Item Collection.

```php
class Item
{
    public $name;
    public $price;
    public $quantity;
}

class Items
{
    private $items;

    /**
     * @param Items[] $items
     */
    public function __construct($items)
    {
        $this->items = $items;
    }
}
```

Implement new entities and/or classes to filter Collection
with conditionals such as
> name == 'item_name1' && (price > 100 || quantity < 10)

Constrains:
* Filter class must be plain and simple and take care only for a certain attribute, i.e. name, price or quantity

