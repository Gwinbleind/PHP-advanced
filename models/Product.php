<?php


namespace models;


class Product
{
    protected $id;
    protected $name;
    protected $price;
    protected $amount;
    protected $category;
    protected $img_small;
    protected $img_medium;
    protected $img_large;

    /**
     * Product constructor.
     * @param $id
     * @param $name
     * @param $price
     * @param $amount
     * @param $category
     * @param $img_small
     * @param $img_medium
     * @param $img_large
     */
    public function __construct($id = null, $name = null, $price = 0, $amount = 1, $category = null, $img_small = '', $img_medium = '', $img_large = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
        $this->category = $category;
        $this->img_small = $img_small;
        $this->img_medium = $img_medium;
        $this->img_large = $img_large;
    }
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    public function __get($name)
    {
        return $this->name;
    }

    //Рендер мини-ячейки продукта в выпадающей корзине
    public function renderMiniCartItem()
    {
        return "<div class=\"cart__product\">
            <img src=\"{$this->img_small}\" alt=\"\" class=\"cart__prod_img\">
            <div class=\"cart__prod_title\">{$this->name}</div>
            <img src=\"img/stars5.jpg\" alt=\"stars\" class=\"cart__prod_stars\">
            <div class=\"cart__prod_price\">{$this->amount}&nbsp<span class=\"price_x\">x</span>&nbsp{$this->price}</div>
            <a @click.stop.prevent=\"handleByClick(id)\" href=\"#\">
                <i data-product__id=\"{$this->id}\" class=\"cart__prod_del fa fa-times-circle\"></i>
            </a>
        </div>";
    }
    //Рендер строки продукта на странице корзины
    public function renderCartItem()
    {
        return "<div class=\"product__element\">
            <a href=\"\" class=\"product__content\">
                <img class=\"product__img\" src=\"{$this->img_medium}\" alt=\"\">
                <div class=\"product__name\">{$this->name}</div>
                <div class=\"product__price\">{$this->price}.00</div>
            </a>
            <a href=\"#\" @click.stop.prevent=\"handleByClick(id)\" class=\"product__add\" data-product__id=\"{$this->id}\">Add to Cart</a>
            <img src=\"img/stars5.jpg\" alt=\"stars\" class=\"product__stars\">
        </div>";
    }
}