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

## Sprint 6
- Durant aquest sprint he corregit errors pendents del sprint anterior i m’he assegurat que tots els tests funcionin correctament després de les modificacions

- He modificat el model de vídeos per afegir la relació amb sèries i he implementat la funcionalitat perquè els usuaris regulars puguin fer CRUD de vídeos amb les seves vistes corresponents

- He creat la migració de les sèries amb els camps indicats i el seu model amb les funcions testedBy, videos, i els accessors formats per a la data

- He implementat dos controladors: el SeriesManageController per a la gestió de sèries amb totes les funcions del CRUD, i el SeriesController per mostrar l’índex i el detall públic de cada sèrie

- He creat les vistes necessàries per al CRUD de sèries i la vista pública on es poden veure totes les sèries i navegar-hi, amb un enllaç als vídeos de cada sèrie

- He afegit la funció create_series() al helper per generar 3 sèries automàticament amb usuaris generats per fàbrica

- He creat els permisos de gestió de sèries i els he assignat als rols super_admin i video_manager

- He afegit els tests al fitxer SerieTest per comprovar la relació entre sèrie i vídeos

- He creat un test funcional SeriesManageControllerTest amb autenticació de diferents tipus d’usuaris i proves d’accés a les funcionalitats del CRUD segons els permisos

- He afegit totes les rutes protegides per middleware per a la gestió de sèries i per a mostrar les vistes públiques d’aquestes només quan l’usuari està logejat

- He revisat tots els fitxers creats amb Larastan per assegurar la qualitat del codi i el compliment de bones pràctiques


## Sprint 7
- He corregit els errors detectats durant el Sprint 6 i m’he assegurat que els tests dels sprints anteriors funcionin correctament després de les modificacions.

- He afegit la funcionalitat perquè els usuaris regulars puguin crear sèries i afegir vídeos a aquestes, si tenen els permisos corresponents.

- He creat l’event VideoCreated amb el constructor i la funció broadcastOn() per transmetre l’event via broadcast.

- Al VideoController, he fet que l’event VideoCreated es dispari correctament quan es crea un nou vídeo.

- He implementat el listener SendVideoCreatedNotification amb la funció handle(VideoCreated $event), que envia un correu als administradors i envia la notificació VideoCreated amb informació del vídeo.

- He creat i configurat app/Providers/EventServiceProvider.php, registrant-hi l’event VideoCreated i el seu listener corresponent.

- M’he registrat a Mailtrap per utilitzar el seu servidor SMTP, i he configurat el fitxer .env amb les credencials corresponents.

- També m’he registrat a Pusher i he configurat les seves credencials al fitxer .env, i he verificat que el fitxer config/broadcasting.php estigui configurat correctament per utilitzar Pusher com a driver per defecte.

- A l’event App\Events\VideoCreated, he afegit la funció broadcastAs() i he comprovat que implementa la interfície ShouldBroadcast.

- Al SendVideoCreatedNotification, m’he assegurat que Pusher transmet correctament l’event de notificació.

- Al controlador, també he disparat l’event perquè s’enviï la notificació push via Pusher.

- He instal·lat les dependències laravel-echo i pusher-js via npm, i he configurat Laravel Echo a resources/js/bootstrap.js.

- He creat la vista de notificacions push perquè els usuaris puguin veure les notificacions rebudes en temps real, i he implementat l’escolta d’events a través d’Echo.

- He creat la ruta per accedir a les notificacions de vídeos.

- He afegit els tests test_video_created_event_is_dispatched() i test_push_notification_is_sent_when_video_is_created() al fitxer VideoNotificationsTest per verificar el comportament correcte dels events i les notificacions push.

- He verificat tots els fitxers creats amb Larastan per assegurar la qualitat del codi i el compliment de les bones pràctiques.

