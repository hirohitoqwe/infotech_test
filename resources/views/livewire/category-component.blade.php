<div>
    <div class="">
        <p>New category name</p>
        <input type="text" wire:model="new_category">
    </div>
    <div class="input-group">
        <p>New category description</p>
        <textarea class="form-control" wire:model="description" aria-label="With textarea"></textarea>
    </div>
    <div class="m-2">
        <h3>Родительская категория</h3>
        <select wire:model="parentCategory">
            <option value="">Отсутствует</option>
            @foreach($categories as $category)
                <option value={{$category->category_name}}>{{$category->category_name}}</option>
            @endforeach
        </select>
    </div>
    <button wire:click="create">Новая категория</button>
    @if($created)
        <h3>Товар был создан</h3>
    @endif
    <div class="categories">
        @foreach($categories as $category)
            <hr>
            <div class="w-25 h-50 border-3 border-dark">
                <p>Наименование  категории: {{$category->category_name}}</p>
                <p>Количество подкатегорий: {{$category->sub_count}}</p>
                <p>Количество товаров в категории: {{$category->product_count}}</p>
                <p>Наименование родительской категории: {{$category->parent_category ?? "Отсутсвует"}}</p>
                <p>Удалить <button wire:click="delete({{$category->id}})"><i class="bi bi-x-lg"></i></button></p>
            </div>
            <hr>
        @endforeach
    </div>
</div>
