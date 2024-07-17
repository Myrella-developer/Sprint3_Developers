# CRUD en PHP

Este proyecto es una aplicación de lista de tareas (TO-DO list) desarrollada en PHP utilizando la arquitectura MVC (Modelo-Vista-Controlador). 
La aplicación permite crear, editar y eliminar tareas, proporcionando una interfaz simple y eficiente para gestionar las tareas diarias. 
Se ha utilizado Tailwind CSS para el diseño de la interfaz y JSON para la manipulación de datos.

## Características

- **Crear Tareas**: Permite a los usuarios añadir nuevas tareas con nombre, descripción, fechas de inicio y fin, y estado.
- **Editar Tareas**: Los usuarios pueden actualizar la información de las tareas existentes.
- **Eliminar Tareas**: Funcionalidad para borrar tareas de forma segura con confirmación.
- **Gestión de Estados**: Las tareas pueden tener diferentes estados como completado, pendiente, en progreso, etc.
- **Interfaz Intuitiva**: Una interfaz de usuario clara y fácil de usar gracias a Tailwind CSS.
- **JSON**: Utilización de JSON para la manipulación y transferencia de datos.

## Tecnologías Utilizadas

- **PHP**: Lenguaje de programación del lado del servidor.
- **HTML/CSS**: Para la estructura y el estilo de las páginas web.
- **Tailwind CSS**: Framework de CSS para diseñar interfaces de usuario.
- **JSON**: Para la manipulación y transferencia de datos.
- **MVC**: Arquitectura de software para separar la lógica de la aplicación en Modelo, Vista y Controlador.

## Estructura del Proyecto

El proyecto sigue una estructura organizada en carpetas:

- **app**: Contiene los controladores, modelos y vistas.
  - **controllers**: Controladores de la aplicación.
  - **models**: Modelos que manejan la lógica de negocio y la interacción con la base de datos.
  - **views**: Vistas que gestionan la presentación de la información al usuario.
- **config**: Archivos de configuración, incluyendo la conexión a la base de datos.
- **lib**: Bibliotecas externas y archivos de soporte.
- **web**: Archivos públicos accesibles desde la web, como estilos, scripts e imágenes.

## Funcionalidades Implementadas

### 1. Crear Tareas
El formulario de creación de tareas permite a los usuarios ingresar el nombre, descripción, fechas de inicio y fin, y estado de la tarea. Este formulario se encuentra en la vista `app/views/task/create.phtml` y utiliza Tailwind CSS para el diseño.

### 2. Editar Tareas
La funcionalidad de edición permite a los usuarios modificar la información de las tareas existentes. El formulario de edición se encuentra en la vista `app/views/task/edit.phtml`. La lógica para la actualización de tareas está en `TaskController.php`.

### 3. Eliminar Tareas
Para eliminar una tarea, se utiliza un formulario de eliminación con confirmación para asegurar que la tarea se borre intencionalmente. Este formulario se encuentra en la vista de edición y la lógica correspondiente está en `TaskController.php`.

### 4. Gestión de Estados
Las tareas pueden tener diferentes estados que se pueden gestionar desde el formulario de creación y edición. Esto permite a los usuarios hacer seguimiento del progreso de sus tareas.

