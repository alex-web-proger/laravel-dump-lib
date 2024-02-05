## Импорт/экспорт БД в Laravel
Пакет Laravel для экспорта/импорта содержимого базы данных и экспорта
отдельных таблиц
### Установка

```sh
 composer require alexlen/laravel-dump-lib
```
Если требуется изменить настройки, нужно выполнить публикацию файла конфигурации:
```sh
 php artisan vendor:publish --tag=alexlendump
```

### Описание
Каталог расположения дампа по умолчанию: storage/app/dump

Каталог расположения бекапов по умолчанию: storage/app/backup

Работа посредством класса <code>Alexlen\DumpLib\DumpDb</code>



