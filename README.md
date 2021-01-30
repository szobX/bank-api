## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


#DOKUMETNACJA:
---------------

aby uruchomić projekt należy:


1. utworzyć oraz podmienić w pliku .env( jeśli nie ma to skopiować z .env.example) hosta, nazwe bazy danych, użytkownika oraz hasło
1. zainstalować paczki composera  ```composer install```
2. utworzyć migrację bazy danych 
     - jeśli chcemy uruchomić bez danych testowych używamy ```php artisan mirage```
  
    - jesli chcemy użyć danych testowych używamy ```php artisan serve --seed```

3. jeśli wybierzemy opcję pustej bazy to musimy utworzyć przynamniej jeden bank komendą : ```php artisan bank-add {nazwa_banku} {4 cyfrowy identifikator bnaku}``` 
4. tworzymy specjalne klucze do autoryzacji :```php artisan passport:install```
5. używamy ```php artisan key:generate```

## ROUTING

------------
# ACCOUNT

----------------------------

-  `/accounts`      -  Display all accounts    -  `GET` -  

-  `/accounts`   -  Add account     - `POST`-    
   
        
        bank_id Int 
        account_name
        
        ** RESZTA GENEROWANE PO BACKENDZIE **
        zwraca cały nowy obiekt konta     
   
-  `/accounts`   -  Edit account     - `PUT`


-  `/accounts/{id}`   -  Delete account     - `DELETE`

        id:id

-  `/accounts/{account_id}`   -  Display account     - `GET` 

           id: 
           ** ZWRACA WYBRANE KONTO { TYLKO DLA ZALOGOWANEGO } **

-  `/accounts/{account_id}/creditCards`   -  Display cards for account     - `GET`- 

        
        
         filtry:
              type,active 
    
     ** ZWRACA WSZYSTKIE KARTY KREDYTOWE USERA { TYLKO DLA ZALOGOWANEGO } **

-  `/accounts/{account_id}/creditCards`   -  Add cards for account     - `POST`- 

      
     
       type: MasterCard,Visa,etc...,
       
     ** TWORZY NOWĄ KARTE  { TYLKO DLA ZALOGOWANEGO } **
 

-  `/accounts/{account_id}/creditCards/{card_id}`   -  delete card from account     - `DELETE`- 



-  `/accounts/{account_id}/transactions`   -  Edit card for account     - `POST`- 

      
      filtry:
      title,tranfer_type



# BANK

----------------------------

-  `/banks`      -  Display all Banks    -  `GET` -      
   

   dodanie banku przez CLI:
 ```$ php artisan bank {name} {identify 4 char}```







# USER

----------------------------
-  `/login`      -  Login   -  `POST` -      


    email
    password
    
    return JWT token


- `/register`    - Register - `POST` -

-  `/auth/me`      -  fetch data for user by token    -  `GET` -      


