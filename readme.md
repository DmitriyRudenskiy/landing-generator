# Запуск тестов
php vendor/bin/phpunit --bootstrap vendor/autoload.php


# Запуск тестового проекта
http://localhost:8081/admin/users

# Закрытая часть


curl -v -X POST -d 'login=test@mail.local&password=111' "http://localhost:8000/v1/login"




===
ALTER TABLE mobile_app.post ADD text VARCHAR(255) NULL;



http://localhost:8000/v1/cities
http://localhost:8000/v1/companies/1
http://localhost:8000/v1/company/view/1




                        
                        
                        <li><a href="{{ route('admin_user_index') }}">Коментарии<span class="pull-right hidden-xs showopacity glyphicon glyphicon-comment"></span></a></li>
                        <li><a href="{{ route('admin_company_index') }}">Компании<span class="pull-right hidden-xs showopacity glyphicon glyphicon-map-marker"></span></a></li>