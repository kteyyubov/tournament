# Tournament

### Requirements

- Docker

###Application
```bash
#1 Build and run
make

#2 Run Migration
make db-migrate

#3 Load Fixtures
make db-fixtures

#Check other options
make help
```

###Routing

```
# Application domain
http://localhost:8080
```

```
# Create tournament
POST /api/tournaments 
content-type: application/json
{
  "name": "FIFA",
}
```

```
# Create participat for tournament
POST /api/tournaments/{tournamentId}/participants
content-type: application/json
{
  "name": "Latvia",
  "division": "A"
}
```

```
# Run tournament
POST /api/tournaments/{tournamentId}/play
```

```
# Get tournament results
GET /api/tournaments/{tournamentId}
```


