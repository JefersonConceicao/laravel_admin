//CORE Scripts - scripts de estrutura
import Dropzone from 'dropzone';
Dropzone.autoDiscover = false;

window.AppNavigation = require('./Core/AppNavigation');
window.AppUsage = require('./Core/AppUsage');
window.AppSettings = require('./Core/AppSettings');

//AUTH Scripts - scripts em telas de authenticação/recuperação de senha
window.AppLogin = require('./Auth/AppLogin');

//LOGGED Scripts - scripts em módulos do sistema
window.AppUsers = require('./Logged/AppUsers');
window.AppProfile = require('./Logged/AppProfile');
window.AppPermissoes = require('./Logged/AppPermissoes');
window.AppModulos = require('./Logged/AppModulos');
window.AppFuncionalidades = require('./Logged/AppFuncionalidades');
window.AppRoles = require('./Logged/AppRoles');
window.AppUF = require('./Logged/AppUF');
window.AppTerritoriosTuristicos = require('./Logged/AppTerritoriosTuristicos');
window.AppZonasTuristicas = require('./Logged/AppZonasTuristicas');

//CONSTANTS Scripts - scripts re-utilizaveis
window.languageDataTable = require('./Constants/language_dataTable');

//LIBS - scripts bibliotecas
window.Swal = require('sweetalert2');        