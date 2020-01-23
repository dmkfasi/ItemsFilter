###Есть фиксированный класс данных и коллекция.

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

Нужно дописать классы, чтобы можно было выполнять фильтрацию Items подобным образом:
> name == 'item_name1' && (price > 100 || quantity < 10)

Ограничения:
* классы фильтрации должны быть простыми (не работать более чем с одним атрибутом данных, т.е. проверять либо только price, либо тоьлко name, либо quantity)

