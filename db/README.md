Class: Personne
--------------
Attributes:
- id
- firstName
- lastName
- genre
- email
- phonenumber
- avatar
- created_at
- updated_at
- deleted_at

Relationships:
- Has One Contact (One-to-One relationship)

Class: Contact
--------------
Attributes:
- id
- personne_id
- fonction
- created_at
- updated_at
- deleted_at

Relationships:
- Belongs To Personne (One-to-One relationship)

Class: ContactRepository
------------------------
Methods:
- find($id): Contact
- all($filters, $skip, $limit): Collection<Contact>
- create($data): Contact
- update($data, $id): Contact
- delete($id): void

Class: PersonneRepository
-------------------------
Methods:
- find($id): Personne
- all($filters, $skip, $limit): Collection<Personne>
- create($data): Personne
- update($data, $id): Personne
- delete($id): void

Class: ContactAPIController
---------------------------
Methods:
- index(Request $request): JsonResponse
- show($id): JsonResponse
- store(CreateContactAPIRequest $request): JsonResponse
- update($id, UpdateContactAPIRequest $request): JsonResponse
- destroy($id): JsonResponse

Class: PersonneAPIController
-----------------------------
Methods:
- index(Request $request): JsonResponse
- show($id): JsonResponse
- store(CreatePersonneAPIRequest $request): JsonResponse
- update($id, UpdatePersonneAPIRequest $request): JsonResponse
- destroy($id): JsonResponse
