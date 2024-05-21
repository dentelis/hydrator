# dentelis/hydrator
Extremely fast php object and array hydrator with strict type matching, array typing, enums and type unions.

Converts simple data (obtained from json_decode or elsewhere) into objects/arrays of objects with strict typing.

## Pros
 - really fast (add proofs!)
 - support typed arrays
 - support nested objects/arrays
 - support enums (both baked & unbaked)
 - support union object type in object properties and arrays (union of scalar types is unsupported)
 - uses constructor as well as overrides values


## ToDO

- [ ] add examples
- [ ] add readme
- [ ] add speed comparison
- [ ] review exceptions
- [ ] add map support
- [ ] full union type support
- [ ] add extract method
- [ ] add native classes support (eg datetime etc)
- [ ] add extensions support