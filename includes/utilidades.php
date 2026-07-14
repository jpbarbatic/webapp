<?php

function mensaje_log($mensaje)
{
    file_put_contents(__DIR__ . '/../log.txt', date('Ymd H:i') . ' - ' . $_SERVER['REMOTE_ADDR'] . ' - ' . $mensaje . PHP_EOL, FILE_APPEND);
}

/**
 * ruta
 *
 * @param  mixed $r
 * @param  mixed $usarParams
 * @param  mixed $params
 * @param  mixed $delParams
 * @return void|string
 */
function ruta($r, $usarParams = false, $params = null, $delParams = null)
{
    //$url = URL_BASE . $r;
    $url = $r;
    if ($usarParams) {
        $parts = parse_url($_SERVER['REQUEST_URI']);
        $lastParams = [];

        if (isset($parts['query'])) {
            parse_str($parts['query'], $lastParams);
        }

        if ($params) {
            foreach ($params as $p => $v) {
                $lastParams[$p] = $v;
            }
        }

        if ($delParams and !empty($lastParams)) {
            foreach ($delParams as $p) {
                unset($lastParams[$p]);
            }
        }

        if (!empty($lastParams)) {
            $url .= '?' . http_build_query($lastParams);
        }
        //print_r($lastParams);
    }

    return $url;
}


function ordenar_por_columna($text, $field, $default = false)
{
    $q = $_SERVER['QUERY_STRING'];
    parse_str($q, $params);
    $icon = "sort-down";

    if (isset($params['orden']) and $params['orden'] == $field) {
        if (isset($params['orden_dir']) and $params['orden_dir'] == 'asc') {
            $icon = "sort-up";
        }
        if (isset($params['orden_dir']) and $params['orden_dir'] == 'desc') {
            $icon = "sort-down";
        }
        $params['orden_dir'] = isset($_GET['orden_dir']) ? ($_GET['orden_dir'] == 'desc' ? 'asc' : 'desc') : 'asc';
    } else {
        $icon = "sort";
        $params['orden_dir'] = 'asc';
    }

    if ($default and !isset($params['orden'])) {
        $icon = "sort-up";
        $params['orden_dir'] = 'desc';
    }

    $params['orden'] = $field;
    if (isset($params['p'])) {
        unset($params['p']);
    }

    $parts = parse_url($_SERVER['REQUEST_URI']);

    $url = $parts['path'] . '?' . http_build_query($params);
    $html = "<a class=\"orden\" href=\"{$url}\"><nobr>{$text} <i class=\"bi bi-{$icon}\"></i></nobr></a> ";

    return $html;
}

function html_opciones2($opciones, $seleccion, $id, $valor)
{
    $html = '';
    foreach ($opciones as $opcion) {
        $selected = $seleccion == $opcion[$id] ? 'selected' : '';
        $html .= "<option value='" . $opcion[$id] . "' $selected>" . $opcion[$valor] . "</option>\n";
    }
    return $html;
}

function html_opciones($opciones, $indice, $clave = null, $valor = null)
{
    $html = '';
    foreach ($opciones as $k => $opcion) {
        if ($clave and $valor) {
            $selected = (isset($indice) and $indice == $opcion[$clave]) ? ' selected' : '';
            $html .= "<option value=\"$opcion[$clave]\"$selected>$opcion[$valor]</option>" . PHP_EOL;
        } else {
            $selected = (isset($indice) and $indice == $k) ? ' selected' : '';
            $html .= "<option value=\"$k\"$selected>$opcion</option>" . PHP_EOL;
        }
    }

    return $html;
}

function html_input_valor($formulario, $campo, $defecto = '')
{
    return isset($formulario[$campo]) ? htmlspecialchars($formulario[$campo], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', true) : $defecto;
}

/**
 * paginacion
 *
 * @return array
 */
function paginacion()
{
    $p = isset($_GET['p']) ? $_GET['p'] : 1;
    $items_pagina = 10;
    $offset = ($p - 1) * $items_pagina;
    $orden = isset($_GET['orden']) ? $_GET['orden'] : 'id';
    $orden_dir =  isset($_GET['orden_dir']) ? $_GET['orden_dir'] : 'asc';
    return compact('p', 'items_pagina', 'offset', 'orden', 'orden_dir');
}

function es_visible(string $vista)
{
    return preg_grep("/^$vista\.*/", array_column($_SESSION['permisos'], 'nombre'));
}

/**
 * Valida un array de datos basado en reglas de cadena separadas por '|'
 *
 * @param array $datos Típicamente $_POST o $_GET
 * @param array $validacion Array de campos y sus respectivas validacion
 * @param array $mensajesPersonalizados Mensajes de error personalizados (opcional)
 * @return array Devuelve ['errores' => [...], 'validados' => [...]]
 */
function validar_formulario(array $datos, array $validaciones, array $mensajesPersonalizados = []): array
{
    $errores = [];
    $validados = [];

    // Registro de validadores (patrón Strategy)
    $validadores = [
        'required' => function ($valor) {
            return !($valor === null || $valor === '' || (is_array($valor) && empty($valor)));
        },
        'email' => function ($valor) {
            return filter_var($valor, FILTER_VALIDATE_EMAIL) !== false;
        },
        'alpha' => function ($valor) {
            return preg_match('/^[\p{L}\p{M}\s]+$/u', $valor);
        },
        'alpha_num' => function ($valor) {
            return preg_match('/^[\p{L}\p{M}\p{N}\s]+$/u', $valor);
        },
        'numeric' => function ($valor) {
            return is_numeric($valor);
        },
        'integer' => function ($valor) {
            return filter_var($valor, FILTER_VALIDATE_INT) !== false;
        },
        'decimal' => function ($valor) {
            return filter_var($valor, FILTER_VALIDATE_FLOAT) !== false;
        },
        'url' => function ($valor) {
            return filter_var($valor, FILTER_VALIDATE_URL) !== false;
        },
        'ip' => function ($valor) {
            return filter_var($valor, FILTER_VALIDATE_IP) !== false;
        },
        'min' => function ($valor, $parametro) {
            if (is_numeric($valor)) return $valor >= (float)$parametro;
            return mb_strlen($valor) >= (int)$parametro;
        },
        'max' => function ($valor, $parametro) {
            if (is_numeric($valor)) return $valor <= (float)$parametro;
            return mb_strlen($valor) <= (int)$parametro;
        },
        'between' => function ($valor, $parametro) {
            $partes = explode(',', $parametro);
            if (count($partes) !== 2) return false;
            $min = (float)$partes[0];
            $max = (float)$partes[1];
            if (is_numeric($valor)) return $valor >= $min && $valor <= $max;
            $longitud = mb_strlen($valor);
            return $longitud >= $min && $longitud <= $max;
        },
        'confirmed' => function ($valor, $parametro, $campo, $datos) {
            $campoConfirmacion = $campo . '_confirmation';
            return isset($datos[$campoConfirmacion]) && $valor === trim($datos[$campoConfirmacion]);
        },
        'in' => function ($valor, $parametro) {
            $valoresPermitidos = array_map('trim', explode(',', $parametro));
            return in_array($valor, $valoresPermitidos, true);
        },
        'regex' => function ($valor, $parametro) {
            return preg_match($parametro, $valor);
        },
        'date' => function ($valor) {
            return strtotime($valor) !== false;
        },
        'after' => function ($valor, $parametro) {
            return strtotime($valor) > strtotime($parametro);
        },
        'before' => function ($valor, $parametro) {
            return strtotime($valor) < strtotime($parametro);
        },
        'password_secure' => function ($valor) {
            return preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $valor);
        }
    ];

    // Mensajes de error por defecto
    $mensajes = [
        'required' => "El campo :campo es obligatorio.",
        'email' => "El campo :campo debe ser un correo electrónico válido.",
        'alpha' => "El campo :campo solo debe contener letras.",
        'alpha_num' => "El campo :campo solo debe contener letras y números.",
        'numeric' => "El campo :campo debe ser un número.",
        'integer' => "El campo :campo debe ser un número entero.",
        'decimal' => "El campo :campo debe ser un número decimal.",
        'url' => "El campo :campo debe ser una URL válida.",
        'ip' => "El campo :campo debe ser una dirección IP válida.",
        'min' => "El campo :campo debe tener al menos :parametro caracteres.",
        'max' => "El campo :campo no puede superar los :parametro caracteres.",
        'between' => "El campo :campo debe estar entre :parametro.",
        'confirmed' => "El campo :campo no coincide con la confirmación.",
        'in' => "El campo :campo debe ser uno de los valores permitidos.",
        'regex' => "El formato del campo :campo no es válido.",
        'date' => "El campo :campo debe ser una fecha válida.",
        'after' => "El campo :campo debe ser posterior a :parametro.",
        'before' => "El campo :campo debe ser anterior a :parametro.",
        'password_secure' => "La contraseña debe tener al menos 8 caracteres, una letra y un número."
    ];

    $mensajes = array_merge($mensajes, $mensajesPersonalizados);

    foreach ($validaciones as $campo => $validacion) {

        $listavalidacion = explode('|', $validacion['reglas']);

        $valor = $datos[$campo] ?? null;

        if (is_string($valor)) {
            $valor = trim($valor);
        }

        $campoValido = true;

        foreach ($listavalidacion as $reglaCompleta) {
            $partes = explode(':', $reglaCompleta, 2);
            $regla = $partes[0];
            $parametro = $partes[1] ?? null;

            if (!isset($validadores[$regla])) {
                throw new InvalidArgumentException("La regla de validación '$regla' no existe.");
            }

            $esValido = $validadores[$regla]($valor, $parametro, $campo, $datos);

            if (!$esValido) {
                $campoValido = false;
                $mensaje = $mensajes[$regla] ?? "El campo $campo no es válido.";
                $mensaje = str_replace(':campo', $campo, $mensaje);
                $mensaje = str_replace(':parametro', $parametro ?? '', $mensaje);

                $errores[$campo][] = $mensaje;

                if ($regla === 'required') {
                    break;
                }
            }

            if (($valor === null || $valor === '') && $regla !== 'required') {
                break;
            }
        }

        // Si el campo pasó todas las validaciones, lo añadimos a validados
        if ($campoValido && !isset($errores[$campo])) {
            $validados[$campo] = $valor;
        }
    }

    return [
        'errores' => $errores,
        'valores' => $validados
    ];
}

function parametro_valido(array $request, string $variable, string  $tipo)
{
    if (!isset($request)) {
        return false;
    }

    if (!isset($request[$variable])) {
        return false;
    }

    if (function_exists($tipo . 'val') and function_exists('is_' . $tipo)) {
        if(('is_' . $tipo)(($tipo . 'val')($request[$variable]))){
            return ($tipo . 'val')($request[$variable]);
        }
    }
}

/**
 * redirigir
 *
 * @param  mixed $ruta
 * @return void
 */
function redirigir($ruta)
{
    header('Location: ' . $ruta);
    exit;
}

/**
 * sendJson
 *
 * @param  mixed $data
 * @param  mixed $cache_time
 * @return void
 */
function sendJson(array $data, int $cache_time = 0)
{
    header('Content-Type: application/json; charset=utf-8');
    if ($cache_time !== 0) {
        header('Cache-Control: public, max-age=' . $cache_time);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cache_time) . ' GMT');
    }
    echo json_encode($data);
}
