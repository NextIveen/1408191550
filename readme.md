# The Test project

## Deploying 

### Manually
- Run docker:

         docker-compose -f docker-compose-dev.yml up -d
         
         docker exec -it -u user test bash

         php artisan migrate
         php artisan db:seed
            
## Authors
- ivannkorsun@gmail.com
