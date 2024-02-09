## Импорт/экспорт БД в Laravel
Пакет Laravel для экспорта/импорта содержимого базы данных и экспорта
отдельных таблиц
### Установка

```sh
 composer require alexlen/laravel-dump-lib
```
Если не устраивают дефолтные настройки, нужно выполнить публикацию файла конфигурации:
```sh
 php artisan vendor:publish --tag=alexlendump
```

### Описание
Каталог расположения дампа по умолчанию: <code>storage/app/dump</code>

Каталог расположения бекапов по умолчанию: <code>storage/app/dump/backup</code>

Работа посредством класса <code>Alexlen\DumpLib\DumpDb</code>:

<table>
    <thead>
        <tr>
            <th>Действие</th>
            <th>Описание</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>DumpDb::export('my_dump.sql');</code></td>
            <td>Сохранить дамп БД в папку <code>storage/app/dump/</code></td>
        </tr>
    </tbody>
</table>



