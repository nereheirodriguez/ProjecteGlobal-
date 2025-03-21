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

## Sprint 4

- En aquest sprint s'han realitzat les següents tasques principals:

- Correcció d'errors del 3r sprint, amb especial atenció als tests per garantir que els usuaris amb els permisos adequats puguin accedir a la ruta /videosmanage.

- Creació del VideosManageController amb les funcions: testedBy(), index(), store(), show(), edit(), update(), delete(), i destroy().

- Creació de la funció index() al VideosController per gestionar la visualització dels vídeos.

- Revisió que tinguessin 3 vídeos creats a helpers i afegits al DatabaseSeeder.

- Creació de les vistes per al CRUD de vídeos, amb accés restringit només als usuaris amb els permisos adequats. Les vistes creades són:

- resources/views/videos/manage/index.blade.php
- resources/views/videos/manage/create.blade.php
- resources/views/videos/manage/edit.blade.php
- resources/views/videos/manage/delete.blade.php
- A la vista index.blade.php, s'ha afegit la taula del CRUD de vídeos per gestionar-los.

- A la vista create.blade.php, s'ha afegit un formulari per crear vídeos, utilitzant l'atribut data-qa per facilitar la identificació en els testos.

- A la vista edit.blade.php, s'ha afegit la taula per editar vídeos.

- A la vista delete.blade.php, s'ha afegit una confirmació d'eliminació dels vídeos.

- Creació de la vista resources/views/videos/index.blade.php on es mostren tots els vídeos, similar a la pàgina principal de YouTube, amb enllaços que porten al detall de cada vídeo (funció show() del sprint anterior).

- Modificació del test user_with_permissions_can_manage_videos() per assegurar que es creen 3 vídeos en les proves.

- Creació dels permisos per al CRUD de vídeos a helpers i assignació dels mateixos als usuaris corresponents.

- A VideoTest, creació de les funcions de test següents:

- user_without_permissions_can_see_default_videos_page()
- user_with_permissions_can_see_default_videos_page()
- not_logged_users_can_see_default_videos_page()
- A VideosManageControllerTest, creació de les següents funcions de test:

- loginAsVideoManager()
- loginAsSuperAdmin()
- loginAsRegularUser()
- user_with_permissions_can_see_add_videos()
- user_without_videos_manage_create_cannot_see_add_videos()
- user_with_permissions_can_store_videos()
- user_without_permissions_cannot_store_videos()
- user_with_permissions_can_destroy_videos()
- user_without_permissions_cannot_destroy_videos()
- user_with_permissions_can_see_edit_videos()
- user_without_permissions_cannot_see_edit_videos()
- user_with_permissions_can_update_videos()
- user_without_permissions_cannot_update_videos()
- user_with_permissions_can_manage_videos()
- regular_users_cannot_manage_videos()
- guest_users_cannot_manage_videos()
- superadmins_can_manage_videos()
- Creació de les rutes de videos/manage per al CRUD de vídeos, amb els corresponents middlewares per garantir que les rutes del CRUD només es mostren si l'usuari està logejat, mentre que la ruta per a l'índex de vídeos es pot veure tant si l'usuari està logejat com si no.

- Afegit el navbar i el footer a la plantilla resources/layouts/videosapp, per permetre la navegació entre pàgines.

- Afegit a resources/markdown/terms un resum de les tasques realitzades durant aquest sprint.

- Comprovació de tot el codi creat mitjançant Larastan per garantir la qualitat i seguretat del mateix.

## Sprint 5

- En aquest sprint s'han realitzat les següents tasques principals:

- Correcció d'errors del 4t sprint per garantir el correcte funcionament de les funcionalitats.

- Afegida del camp user_id a la taula de vídeos per identificar quin usuari ha creat cada vídeo. Això ha requerit modificar el model, controller, i helpers corresponents per assegurar que s'assigni correctament aquest camp en crear un vídeo.

- Revisió i correcció dels errors que podrien haver afectat els tests d'un sprint anterior en modificar el codi.

- Creació del UsersManageController amb les funcions: testedBy(), index(), store(), edit(), update(), delete(), i destroy() per gestionar els usuaris.

- Creació de les funcions index() i show() al UsersController per permetre la visualització dels usuaris i els seus vídeos.

- Creació de les vistes per al CRUD d'usuaris amb accés restringit només als usuaris amb els permisos adequats. Les vistes creades són:

- resources/views/users/manage/index.blade.php
- resources/views/users/manage/create.blade.php
- resources/views/users/manage/edit.blade.php
- resources/views/users/manage/delete.blade.php
- A la vista index.blade.php, s'ha afegit la taula del CRUD d'usuaris per gestionar-los.

- A la vista create.blade.php, s'ha afegit un formulari per crear usuaris, utilitzant l'atribut data-qa per facilitar la identificació en els testos.

- A la vista edit.blade.php, s'ha afegit la taula per editar usuaris.

- A la vista delete.blade.php, s'ha afegit una confirmació d'eliminació dels usuaris.

- Creació de la vista resources/views/users/index.blade.php on es mostren tots els usuaris amb possibilitat de cercar-los, i al clicar sobre un usuari, es visualitza el seu detall i els seus vídeos.

- Creació dels permisos per a la gestió d'usuaris per al CRUD i assignació d'aquests permisos als usuaris superadmin a helpers.

- A UserTest, creació de les funcions de test següents:

- user_without_permissions_can_see_default_users_page()
- user_with_permissions_can_see_default_users_page()
- not_logged_users_cannot_see_default_users_page()
- user_without_permissions_can_see_user_show_page()
- user_with_permissions_can_see_user_show_page()
- not_logged_users_cannot_see_user_show_page()
- A UsersManageControllerTest, creació de les següents funcions de test:

- loginAsVideoManager()
- loginAsSuperAdmin()
- loginAsRegularUser()
- user_with_permissions_can_see_add_users()
- user_without_users_manage_create_cannot_see_add_users()
- user_with_permissions_can_store_users()
- user_without_permissions_cannot_store_users()
- user_with_permissions_can_destroy_users()
- user_without_permissions_cannot_destroy_users()
- user_with_permissions_can_see_edit_users()
- user_without_permissions_cannot_see_edit_users()
- user_with_permissions_can_update_users()
- user_without_permissions_cannot_update_users()
- user_with_permissions_can_manage_users()
- regular_users_cannot_manage_users()
- guest_users_cannot_manage_users()
- superadmins_can_manage_users()
- Creació de les rutes de users/manage per al CRUD d'usuaris, amb els corresponents middlewares per garantir que les rutes del CRUD només es mostren si l'usuari està logejat, mentre que les rutes d'índex i show són accessibles tant si l'usuari està logejat com si no.

- S'ha afegit la funcionalitat per permetre la navegació entre pàgines.

- Afegit a resources/markdown/terms un resum de les tasques realitzades durant aquest sprint.

- Comprovació de tot el codi creat mitjançant Larastan per garantir la qualitat i seguretat del mateix.
