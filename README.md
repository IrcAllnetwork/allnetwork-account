# AllNetwork Oauth2 Server
## How to install
- Clone this repository
- Run composer install
- Run bower install


## Configuration
#### /storage/config/app.yaml
```yaml
name:               'applicationName'
version:            '0.1.1'
env:                'dev'
basePath:           ''
srcPath:            'src'
templateExtension:  'twig'
cache:              false
usePropel:          true
useTwig:            true
response:           'json'
serviceURL:         'http://xmlrpc-service-url'

```

#### /storage/config/database.yaml
```yaml
driver:     'mysql'
host:       'database_host'
user:       'database_user'
password:   'database_password'
name:       'database_name'
port:       3306
charset:    'utf8'

```
#### /storage/config/rbac.yaml
```yaml
whiteList:
    - /
    - /signin
    - /token
    - /resource

```
