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


## Sprint 3
- En aquest sprint s'han realitzat les següents tasques principals:

- Correcció d'errors del 2n sprint.
- Gestió de permisos: Instal·lació del paquet spatie/laravel-permission i definició dels permisos per als diferents rols d'usuari.
- Modificació del model d’usuaris: Creació de la migració per afegir el camp super_admin, i implementació de les funcions testedBy() i isSuperAdmin().
- Creació i gestió d'usuaris:
- Modificació de create_default_professor per afegir el rol de superadmin.
- Nova funció add_personal_team() per gestionar la creació d’equips.
- Creació de funcions per generar usuaris predeterminats:
- create_regular_user()
- create_video_manager_user()
- create_superadmin_user()
- Definició de permisos i portes d’accés a AppServiceProvider.
- Actualització del DatabaseSeeder amb permisos i usuaris per defecte (superadmin, regular user, video manager).
- Publicació i personalització dels stubs en Laravel.
- Tests:
- VideosManageControllerTest a tests/Feature/Videos, amb proves sobre la gestió de vídeos segons els permisos.
- UserTest a tests/Unit, per comprovar la funció isSuperAdmin().
- Verificació de codi amb Larastan per garantir qualitat i seguretat.
