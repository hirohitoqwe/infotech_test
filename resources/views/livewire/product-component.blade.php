<div>
    <input type="text" wire:model="product_name">
    <input type="number" wire:model="product_price">
    <button wire:click="create">Новый продукт</button>
    @if($created)
        <h3>Товар был создан</h3>
    @endif
</div>
