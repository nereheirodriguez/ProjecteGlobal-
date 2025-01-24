# Resum dels dos sprints

## Objectiu principal
El principal objectiu és desenvolupar una aplicació web similar a YouTube que permeti crear usuaris, gestionar vídeos i llistes. Aquesta aplicació es desenvoluparà durant el curs a través de diversos sprints.

---

## Sprint 1
- Es va iniciar el projecte amb Laravel i es van configurar les opcions necessàries (Jetstream, Livewire, PHPUnit, SQLite).
- Es van crear tests per a comprovar la funcionalitat dels *helpers*, incloent la creació d’usuaris per defecte (usuari genèric i professor). Els usuaris s’han associat a un *team*.
- Es van configurar credencials per defecte a la carpeta `config` i al fitxer `.env`.
- Es va seguir la metodologia TDD i AAA per a implementar i documentar els tests.

---

## Sprint 2
- Es van corregir els errors detectats al 1r sprint i es van configurar els tests perquè utilitzin una base de dades temporal.
- Es va crear la migració i el model de vídeos amb atributs com: id, títol, descripció, URL, data de publicació i referències a altres vídeos (*previous*, *next*) i a una sèrie (*series_id*).
- Es van implementar funcions al model per formatar la data de publicació amb la llibreria Carbon.
- Es va desenvolupar el controlador i les vistes per mostrar els vídeos (incloent la ruta *show*).
- Es van afegir usuaris i vídeos per defecte al *DatabaseSeeder*.
- Es va implementar un nou *layout* i es van afegir funcionalitats als *helpers*.
- Es van crear tests de funcionalitat per verificar la visualització de vídeos i comprovar el comportament amb vídeos inexistents.
- Es va instal·lar i configurar Larastan per analitzar el codi, detectar errors i corregir-los.

Aquest treball permet establir una base sòlida per a continuar desenvolupant funcionalitats més avançades als propers sprints.
