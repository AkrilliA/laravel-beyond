# `beyond:make:process`
Creates a new process. A process is made up of one or more actions and produces the desired 
result. A process for creating the user would look like this, for example: Validate the request, 
create the user, send an e-mail, send a notification to the administrator. This process is 
individual for each application, e.g. the process in the administration application could 
dispense with sending the notification to the administrator.

## Signature 
`beyond:make:process {name} {--force}`

| Parameters | Description             |
|------------|-------------------------|
| name       | The name of you process |

| Flags   | Description             |
|---------|-------------------------|
| --force | Overwrite existing file |
