## Musement test project (Author is `Artsem Shulga`)

### Installation:
* be sure to have `PHP ^7.4` and `Composer` installed;
* clone project;
* clone `.env.example` as `.env`;
* run `composer install`.
  
### Execution:
* run project in console like `echo | php index.php`.

### API designs:
If I got that right, we need 2 routes like:
1. saving forecast for specific city:
    * `POST|PUT /api/v3/cities/{id}/forecast/{date}`
    
2. getting forecast for specific city:
    * `GET /api/v3/cities/{id}/forecast/{date}`
    
That way we'll be able to store and read forecast for any city and date.