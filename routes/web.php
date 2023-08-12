<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'UsuariosController@Inicio');
Route::get('/logout', 'UsuariosController@logout');
Route::get('/Contenido/GradosxAsignatura/{id}', 'ContenidoController@GradosxAsignatura');
Route::get('/Contenido/GradosxAsignaturaSinCont/{id}', 'ContenidoController@GradosxAsignaturaSinCont');

Route::get('/Contenido/GradosxAsignaturaDoc/{id}', 'ContenidoController@GradosxAsignaturaDoc');
Route::get('/Contenido/GradosxEstud/{id}', 'ContenidoController@GradosxEstud');
Route::get('/Contenido/Asignaturas/{id}/{alu}', 'ContenidoController@Asignaturas');
Route::get('/Contenido/GradosxEstud2/{id}/{Grup}', 'ContenidoController@GradosxEstud2');
Route::get('/Contenido/PresentacionCont/{id}/{alu}', 'ContenidoController@PresentacionCont');
Route::get('/Contenido/Calificaciones/{id}/{alu}', 'ContenidoController@Calificaciones');
Route::get('/Contenido/ZonaLibre/{alu}', 'ContenidoController@ZonaLibre');
Route::get('/Contenido/VerTemas/{id}', 'ContenidoController@VerTema');
Route::get('/Evaluaciones/ActEval/{id}/{Clasif}', 'ContenidoController@VerActEval');
Route::get('/Animaciones/VerAnimaciones/{id}', 'ContenidoController@VerAnimaciones');
Route::get('/Contenido/AsignaturasxDoce', 'ContenidoController@VerAsigxDoce');

Route::post('/Cambiar/ContenidoEva', 'ContenidoController@CambiarEvalModal');
Route::post('/Login/Entrar', 'UsuariosController@Entrar');
Route::post('/Login/EntrarDocente', 'UsuariosController@EntrarDocente');
Route::get('/Login/LoginDocente', 'UsuariosController@LoginDocente');


Route::post('/Guardar/RespEvalPregEnsayo', 'ContenidoController@GuardarRespEval');
Route::post('/Guardar/RespEvalDida', 'ContenidoController@GuardarRespEvalDida');
Route::post('/Guardar/RespEvalMult', 'ContenidoController@GuardarRespEvalMul');
Route::post('/Guardar/RespEvalGrupPreg', 'ContenidoController@GuardarRespEvalGruPreg');
Route::post('/Guardar/RespEvalTall', 'ContenidoController@GuardarRespTall');
Route::post('/Guardar/RespEvalVerFal', 'ContenidoController@GuardarRespVerFal');
Route::post('/Guardar/RespEvalVerFal', 'ContenidoController@GuardarRespVerFal');
Route::post('/Guardar/RespEvalComplete', 'ContenidoController@GuardarRespComplete');
Route::post('/Guardar/RespEvalRel', 'ContenidoController@GuardarRespRelacione');
Route::post('/Guardar/RespEvalTaller', 'ContenidoController@GuardarRespTaller');

Route::post('/cambiar/ContenidoDocumentoLibre', 'ContenidoController@CambiarContenidoModaZonaLibre');
Route::post('/cambiar/ContenidoArchZona', 'ContenidoController@CambiarArchModalZona');
Route::post('/Consultar/ContenidoAnimZonaLibre', 'ContenidoController@CambiarAnimZonaLibre');
Route::post('/Consultar/ContenidoLinkZonaLibre', 'ContenidoController@CambiarLinkZonaLibre');


Route::post('/Asignaturas/consulPregAlumno', 'ContenidoController@consulPregAlumno');
Route::post('/Guardar/RespEvaluaciones', 'ContenidoController@GuardarRespEvaluaciones');

/////LABORATORIOS
Route::get('/Contenido/Laboratorios/{id}', 'ContenidoController@Laboratorios');
Route::post('/Contenido/MostLaboratorios', 'ContenidoController@MostLaboratorios');
Route::post('/Contenido/MostDetLaboratorios', 'ContenidoController@MostDetLaboratorios');
Route::post('/Contenido/ContenidoEva', 'ContenidoController@CambiarEvalModal');


/////MODULOS TRANSVERSALES
Route::get('/Contenido/GradosxModulos/{id}', 'ContenidoController@GradosxModulos');
Route::get('/Contenido/GradosxModulosDoc/{id}', 'ContenidoController@GradosxModulosDoc');
Route::get('/Contenido/PresentacionContMod/{id}/{alu}', 'ContenidoController@PresentacionContMod');
Route::get('/Contenido/GradosxEstudMod/{id}', 'ContenidoController@GradosxEstudMod');
Route::get('/Contenido/GradosxEstudMod2/{id}/{Grup}', 'ContenidoController@GradosxEstudMod2');
Route::get('/Contenido/VerTemasMod/{id}', 'ContenidoController@VerTemasMod');
Route::get('/Animaciones/VerAnimacionesMod/{id}', 'ContenidoController@VerAnimacionesMod');
Route::get('/Contenido/CalificacionesMod/{id}/{alu}', 'ContenidoController@CalificacionesMod');
Route::get('/Contenido/Modulos/{id}/{alu}', 'ContenidoController@Modulos');
Route::get('/Evaluaciones/ActEvalMod/{id}/{Clasif}', 'ContenidoController@VerActEvalMod');


Route::post('/Calificaciones/ConsulRetroalimentacion', 'ContenidoController@ConsulRetroalimentacion');
Route::post('/Calificaciones/VerRespAlumno', 'ContenidoController@VerRespAlumno');


////MODULO DE JUEGO
Route::get('/Contenido/ZonaPlay/{alu}', 'ContenidoController@ZonaPlay');

////MODULO DE ENTRENAMIENTO
Route::get('/Contenido/moduloE/{alu}', 'ContenidoController@ModuloE');
Route::post('/ModuloE/cargarAsignaturas', 'ContenidoModuloE@cargarAsignaturas');
Route::post('/ModuloE/CargarTemasModuloE', 'ContenidoModuloE@CargarTemasModuloE');
Route::post('/ModuloE/CargaDetTemasModuloE', 'ContenidoModuloE@CargaDetTemasModuloE');
Route::post('/ModuloE/CargarPracticas', 'ContenidoModuloE@CargarPracticas');









