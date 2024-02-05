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
Каталог расположения дампа: storage/app/dump

Перед импортом автоматически создается бекап в каталоге storage/app/dump/backup

Для работы использовать класс <code>Alexlen\DumpLib\DumpDb</code>



