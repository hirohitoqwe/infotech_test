<div>
    <p>
        <input type="text" wire:model="product_name">
        <input type="number" wire:model="product_price">
    </p>
    <div>
        <select wire:model="categories" multiple>
            @foreach($allCategories as $category)
                <option value={{$category->category_name}}>{{$category->category_name}}</option>
            @endforeach
        </select>
    </div>
    <button wire:click="create">Новый продукт</button>
    @if($created)
        <h3>Товар был создан</h3>
    @endif
</div>
