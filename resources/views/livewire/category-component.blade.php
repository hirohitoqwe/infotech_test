<div>
    <div class="float-left m-2">
        <div>
            <label for="n_category_name">Наименование новой категории</label>
            <input type="text" id="n_category_name" class="form-control" wire:model="new_category">
        </div>
        <div>
            <label for="n_category_descr">Описание новой категории</label>
            <textarea id="n_category_descr" style="resize: none" class="form-control bi-textarea-resize"
                      wire:model="description"></textarea>
        </div>
        <div>
            <label for="parent">Родительская категория</label>
            <div>
                <select id="select2-dropdown" name="parent" wire:model="parentCategory">
                    <option value="">Отсутствует</option>
                    @foreach($categories as $category)
                        <option value={{$category->category_name}}>{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button wire:click="create">Создать новую категорию</button>
    </div>
    @if($created)
        <h3>Категория создана</h3>
    @endif
    <div class="categories float-left">
        @foreach($categories as $category)
            <div class="w-50 h-50 border border-secondary p-4 m-2">
                <p>Наименование категории: {{$category->category_name}}</p>
                <p>Описание категории: {{$category->description}}</p>
                <p>Количество подкатегорий: {{$category->sub_count}}</p>
                <p>Количество товаров в категории: {{$category->product_count}}</p>
                <p>Наименование родительской категории: {{$category->parent_category ?? "Отсутсвует"}}</p>
                <p>Удалить
                    <button wire:click="delete({{$category->id}})"><i class="bi bi-x-lg"></i></button>
                </p>
                <p>Редактировать
                    <button wire:click="changeEditCategory({{$category->id}})"><i class="bi bi-pencil"></i></button>
                </p>
                <div class="options">
                    <div class="edit" style="{{$edit === $category->id ? "" :"display:none"}}">
                        <p>
                            <label for="edited_name">Наименование</label>
                            <input type="text" class="form-control" id="edited_name" wire:model="edited.{{"name"}}">
                        </p>
                        <p>
                            <label for="edited_desc">Описание</label>
                            <textarea id="edited_desc" style="resize: none" class="form-control"
                                      wire:model="edited.{{"description"}}"></textarea>
                        </p>
                        <button wire:click="update({{$category->id}})">Обновить</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#select2-dropdown').select2();
        $('#select2-dropdown').on('change', function (e) {
            var data = $('#select2-dropdown').select2("val");
        });
    });
</script>
