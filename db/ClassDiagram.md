+---------------------+        +----------------------+
|      Personne       |        |       Contact        |
+---------------------+        +----------------------+
| - id                 |        | - id                  |
| - firstName          |        | - personne_id         |
| - lastName           |        | - fonction            |
| - genre              |        | - created_at          |
| - email              |        | - updated_at          |
| - phonenumber        |        | - deleted_at          |
| - avatar             |        +----------------------+
| - created_at         |        | +belongsTo(Personne) |
| - updated_at         |        +----------------------+
| - deleted_at         |
| +hasOne(Contact)     |
+---------------------+

+---------------------+        +------------------------+
| ContactRepository   |        | PersonneRepository     |
+---------------------+        +------------------------+
| +find($id): Contact |        | +find($id): Personne   |
| +all($filters...):   |        | +all($filters...):     |
|   Collection<Contact>|        |   Collection<Personne>|
| +create($data):      |        | +create($data):        |
|   Contact            |        |   Personne             |
| +update($data, $id): |        | +update($data, $id):   |
|   Contact            |        |   Personne             |
| +delete($id): void   |        | +delete($id): void     |
+---------------------+        +------------------------+

+---------------------+        +------------------------+
| ContactAPIController |        | PersonneAPIController  |
+---------------------+        +------------------------+
| +index(Request):     |        | +index(Request):       |
|   JsonResponse       |        |   JsonResponse         |
| +show($id):          |        | +show($id):            |
|   JsonResponse       |        |   JsonResponse         |
| +store(Request):     |        | +store(Request):       |
|   JsonResponse       |        |   JsonResponse         |
| +update($id,         |        | +update($id,           |
|   Request):          |        |   Request):            |
|   JsonResponse       |        |   JsonResponse         |
| +destroy($id):       |        | +destroy($id):         |
|   JsonResponse       |        |   JsonResponse         |
+---------------------+        +------------------------+
