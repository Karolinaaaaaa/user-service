# user-service

## Instalacja composer

W katalogu głównym projektu uruchom poniższe polecenie:

```
composer install
```

## Zbudowanie i uruchomienie kontenerów

W katalogu głównym projektu uruchom poniższe polecenie:

```
docker-compose up --build
```

Uruchomi dwa kontenery:
Aplikacja PHP (na porcie 8000).
Baza danych MySQL (na porcie 3307).

## Sprawdzenie stanu kontenerów

Aby upewnić się, że kontenery działają:

```
docker ps
```

## Wykonanie migracji bazy danych (opcjonalnie)

Wejdź do kontenera aplikacji:

```
docker exec -it user-service-app-1 bash
```

## Wewnątrz kontenera uruchom: (opcjonalnie)

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

## Testowanie aplikacji

Formularz użytkownika:
Otwórz w przeglądarce: http://localhost:8000/form

Lista użytkowników:
Otwórz w przeglądarce: http://localhost:8000/users
Przekierowanie jest na login, które nie jest stworzone.(Zabezpieczone przed nieuprawnionym dostępem)
