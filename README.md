**Тестовое задание GromIT, плагин для OctoberCMS**


При разработке использовал БД PostgreSQL.


Тестировал код через консоль

Выполнял команду:
`php artisan tinker`

И передавал следующие строки кода:

```use GromIT\Catalog\Models\Category;

$cat1 = Category::create(['name' => 'Категория 1']);
$cat2 = Category::create(['name' => 'Категория 2']);
$sub1 = Category::create(['name' => 'Подкатегория 1.1', 'parent_id' => $cat1->id]);
$sub2 = Category::create(['name' => 'Подкатегория 1.2', 'parent_id' => $cat1->id]);
$sub2_1 = Category::create(['name' => 'Подкатегория 1.2.1', 'parent_id' => $sub2->id]);

Category::all(['id', 'name', 'parent_id', 'wbs'])->toArray();```


С фронтенд часть у меня возникли непонятные проблемы, я оставил примерную части разработанного фронта, но рабочий только бэкенд
