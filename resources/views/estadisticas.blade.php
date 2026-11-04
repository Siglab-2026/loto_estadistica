
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Loto Estadística | Análisis</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            color: #334155;
        }

        .contenedor {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #ffffff;
            padding: 28px 18px;
        }

        .logo {
            font-size: 21px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 8px;
        }

        .sublogo {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 35px;
        }

        .menu a {
            display: block;
            padding: 14px;
            margin-bottom: 8px;
            color: #475569;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
        }

        .menu a:hover,
        .menu a.activo {
            background: #1e40af;
            color: white;
        }

        .contenido {
            flex: 1;
            padding: 35px;
            min-width: 0;
        }

        .encabezado {
            margin-bottom: 30px;
        }

        .encabezado h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .encabezado p {
            color: #64748b;
            font-size: 14px;
        }

        .tarjetas {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .tarjeta {
            background: #ffffff;
            padding: 22px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .tarjeta p {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 14px;
        }

        .tarjeta h2 {
            font-size: 32px;
            color: #2563eb;
        }

        .panel {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 25px;
        }

        .panel h3 {
            margin-bottom: 8px;
        }

        .descripcion {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .grafico {
            height: 330px;
            position: relative;
        }

        .boton {
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 11px 17px;
            border-radius: 7px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .boton:hover {
            background: #1d4ed8;
        }

        .estado {
            color: #64748b;
            font-size: 13px;
            margin-top: 10px;
        }

        @media(max-width: 1000px) {
            .tarjetas {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 650px) {
            .contenedor {
                display: block;
            }

            .sidebar {
                width: 100%;
            }

            .contenido {
                padding: 20px;
            }

            .tarjetas {
                grid-template-columns: 1fr;
            }
        }


.tabla-contenedor {
    overflow-x: auto;
    max-height: 550px;
    overflow-y: auto;
    margin-top: 20px;
}

.tabla-frecuencias {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.tabla-frecuencias th {
    background: #f1f5f9;
    color: #1d4ed8;
    padding: 13px;
    text-align: center;
    position: sticky;
    top: 0;
}

.tabla-frecuencias td {
    padding: 11px;
    text-align: center;
    border-bottom: 1px solid #e2e8f0;
}

.tabla-frecuencias tr:hover {
    background: #f1f5f9;
}

.numero-destacado {
    color: #2563eb;
    font-weight: bold;
}

.resumen-frecuencias {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-top: 20px;
}

.resumen-frecuencias div {
    background: #f1f5f9;
    padding: 15px;
    border-radius: 8px;
}

.resumen-frecuencias span {
    display: block;
    color: #64748b;
    font-size: 12px;
    margin-bottom: 8px;
}

.resumen-frecuencias strong {
    font-size: 20px;
    color: #2563eb;
}

@media(max-width: 650px) {
    .resumen-frecuencias {
        grid-template-columns: 1fr;
    }
}

.bloque-digitos {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 20px;
}

.tarjeta-digito {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px;
}

.indicadores-digito {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin: 18px 0;
}

.indicador-digito {
    background: #f1f5f9;
    border-radius: 8px;
    padding: 13px;
}

.indicador-digito span {
    display: block;
    color: #64748b;
    font-size: 12px;
    margin-bottom: 8px;
}

.indicador-digito strong {
    color: #2563eb;
    font-size: 20px;
}

.grafico-digito {
    height: 260px;
    position: relative;
    margin-top: 20px;
}

.tabla-digitos {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 13px;
}

.tabla-digitos th,
.tabla-digitos td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #e2e8f0;
}

.tabla-digitos th {
    color: #1d4ed8;
    background: #f1f5f9;
}

@media(max-width: 900px) {
    .bloque-digitos {
        grid-template-columns: 1fr;
    }
}


.interpretacion-digitos {
    margin-top: 25px;
    padding: 22px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
}

.interpretacion-digitos h3 {
    color: #2563eb;
    margin-bottom: 15px;
}

.interpretacion-bloque {
    background: #f1f5f9;
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.interpretacion-bloque h4 {
    color: #1d4ed8;
    margin-bottom: 10px;
}

.interpretacion-bloque p {
    color: #334155;
    font-size: 13px;
    line-height: 1.7;
    margin-bottom: 7px;
}

.conclusion-estadistica {
    padding: 16px;
    background: #eff6ff;
    border-left: 4px solid #3b82f6;
    border-radius: 6px;
    color: #1e40af;
    font-size: 13px;
    line-height: 1.7;
}

    
        .chart-container {
            position: relative;
            width: 100%;
        }

        @media(max-width: 700px) {
            #series > div[style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
        }



/* Diseño claro: mejor contraste y lectura */
body { background: #f3f6fb; color: #1e293b; }
.sidebar { min-height: 100vh; border-right: 1px solid #e2e8f0; box-shadow: 2px 0 12px rgba(15,23,42,.04); }
.logo { letter-spacing: .8px; }
.menu a { transition: background .2s ease, color .2s ease; }
.menu a:hover, .menu a.activo { background: #dbeafe; color: #1d4ed8; font-weight: 600; }
.contenido { max-width: 1700px; margin: 0 auto; }
.encabezado { padding: 8px 2px 18px; border-bottom: 1px solid #e2e8f0; }
.encabezado h1 { color: #0f172a; font-size: 30px; font-weight: 700; letter-spacing: -.5px; }
.tarjeta, .panel, .tarjeta-digito, .interpretacion-digitos { box-shadow: 0 3px 14px rgba(15,23,42,.045); }
.tarjeta { border-top: 3px solid #3b82f6; }
.tarjeta p, .descripcion, .estado { color: #64748b; }
.tarjeta h2 { color: #1d4ed8; }
.panel { margin-bottom: 24px; }
.panel h3 { color: #0f172a; font-size: 18px; }
.panel h4 { color: #334155; }
.tabla-frecuencias th, .tabla-digitos th { background: #eff6ff; color: #1e40af; font-weight: 700; }
.tabla-frecuencias td, .tabla-digitos td { color: #334155; border-bottom-color: #e2e8f0; }
.tabla-frecuencias tbody tr:nth-child(even), .tabla-digitos tbody tr:nth-child(even) { background: #fafcff; }
.tabla-frecuencias tr:hover { background: #eff6ff; }
.resumen-frecuencias div, .indicador-digito, .interpretacion-bloque { background: #f8fafc; border: 1px solid #e2e8f0; }
.resumen-frecuencias span, .indicador-digito span { color: #64748b; }
.resumen-frecuencias strong, .indicador-digito strong { color: #1d4ed8; }
.interpretacion-digitos h3, .interpretacion-bloque h4 { color: #1d4ed8; }
.interpretacion-bloque p { color: #475569; }
.conclusion-estadistica { background: #eff6ff; color: #334155; border-left-color: #3b82f6; }
.boton { background: #2563eb; box-shadow: 0 2px 5px rgba(37,99,235,.18); }
.boton:hover { background: #1d4ed8; }
@media (min-width: 1001px) { .sidebar { position: sticky; top: 0; height: 100vh; } }
@media (max-width: 650px) { .sidebar { min-height: auto; } .menu { display: grid; grid-template-columns: repeat(2,minmax(0,1fr)); gap: 5px; } .menu a { margin: 0; padding: 11px 9px; font-size: 12px; } .encabezado h1 { font-size: 24px; } .panel { padding: 17px; } }


/* Navegación colapsable y encabezado */
.contenedor { transition: none; }
.sidebar {
    flex: 0 0 250px;
    width: 250px;
    min-height: 100vh;
    position: sticky;
    top: 0;
    align-self: flex-start;
    height: 100vh;
    overflow-x: hidden;
    overflow-y: auto;
    border-right: 1px solid #e2e8f0;
    box-shadow: 3px 0 14px rgba(15, 23, 42, .025);
    transition: width .25s ease, flex-basis .25s ease, padding .25s ease;
    z-index: 20;
}
.logo, .sublogo, .menu a { white-space: nowrap; }
.menu a {
    display: flex;
    align-items: center;
    gap: 13px;
    min-height: 44px;
    transition: background .18s ease, color .18s ease;
}
.menu a:hover, .menu a.activo {
    background: #dbeafe;
    color: #1d4ed8;
}
.nav-icono {
    display: inline-flex;
    flex: 0 0 24px;
    width: 24px;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    line-height: 1;
    font-weight: 700;
}
.nav-texto { overflow: hidden; text-overflow: ellipsis; }
.contenido { min-width: 0; }
.encabezado { padding-bottom: 17px; border-bottom: 1px solid #e2e8f0; }
.encabezado-superior { display: flex; align-items: center; gap: 17px; }
.encabezado h1 { color: #172033; letter-spacing: -.45px; }
.btn-menu {
    display: inline-flex;
    flex: 0 0 42px;
    width: 42px;
    height: 42px;
    align-items: center;
    justify-content: center;
    border: 1px solid #dbe5f1;
    border-radius: 11px;
    color: #1d4ed8;
    background: #fff;
    font-size: 21px;
    cursor: pointer;
    transition: background .18s ease, transform .18s ease, box-shadow .18s ease;
}
.btn-menu:hover {
    background: #eff6ff;
    box-shadow: 0 4px 12px rgba(37,99,235,.10);
}
.btn-menu:active { transform: scale(.96); }

/* Estado contraído en escritorio */
.contenedor.menu-colapsado .sidebar {
    flex-basis: 76px;
    width: 76px;
    padding-left: 12px;
    padding-right: 12px;
}
.contenedor.menu-colapsado .logo,
.contenedor.menu-colapsado .sublogo,
.contenedor.menu-colapsado .nav-texto { display: none; }
.contenedor.menu-colapsado .menu a {
    justify-content: center;
    padding: 12px 8px;
    gap: 0;
}
.contenedor.menu-colapsado .nav-icono {
    flex-basis: 28px;
    width: 28px;
    font-size: 21px;
}
.contenedor.menu-colapsado .sidebar { overflow: visible; }
.contenedor.menu-colapsado .menu a { position: relative; }
.contenedor.menu-colapsado .menu a:hover::after {
    content: attr(title);
    position: absolute;
    left: calc(100% + 12px);
    top: 50%;
    transform: translateY(-50%);
    padding: 9px 12px;
    color: #fff;
    background: #172b4d;
    border-radius: 7px;
    font-size: 12px;
    white-space: nowrap;
    z-index: 50;
    box-shadow: 0 5px 14px rgba(15,23,42,.18);
}
@media (max-width: 1000px) and (min-width: 651px) {
    .sidebar { flex-basis: 220px; width: 220px; }
    .contenido { padding: 26px; }
}
@media (max-width: 650px) {
    .contenedor { display: block; }
    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
        min-height: 0;
        padding: 15px 16px;
        border-right: 0;
        border-bottom: 1px solid #e2e8f0;
        overflow: visible;
    }
    .logo { margin-bottom: 3px; }
    .sublogo { margin-bottom: 12px; }
    .menu {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 5px;
    }
    .menu a { margin: 0; padding: 10px 9px; font-size: 12px; }
    .contenedor.menu-colapsado .sidebar {
        width: 100%;
        padding: 13px 16px;
    }
    .contenedor.menu-colapsado .logo,
    .contenedor.menu-colapsado .sublogo { display: block; }
    .contenedor.menu-colapsado .sublogo { margin-bottom: 0; }
    .contenedor.menu-colapsado .menu { display: none; }
    .contenido { padding: 20px; }
    .encabezado-superior { align-items: flex-start; gap: 12px; }
    .encabezado h1 { font-size: 23px; }
}

</style>
</head>

<body>

<div class="contenedor">

    <aside class="sidebar">

        <div class="logo">LA LOTO</div>
        <div class="sublogo">CENTRO DE ANÁLISIS ESTADÍSTICO</div>

        <nav class="menu">
            <a href="#resumen" class="activo" title="Resumen general"><span class="nav-icono">▦</span><span class="nav-texto">Resumen general</span></a>
            <a href="#frecuencias" title="Frecuencias"><span class="nav-icono">▥</span><span class="nav-texto">Frecuencias</span></a>
            <a href="#distribucion" title="Distribución"><span class="nav-icono">▤</span><span class="nav-texto">Distribución</span></a>
            <a href="#probabilidades" title="Probabilidades"><span class="nav-icono">％</span><span class="nav-texto">Probabilidades</span></a>
            <a href="#digitos" title="Análisis de dígitos"><span class="nav-icono">⑨</span><span class="nav-texto">Análisis de dígitos</span></a>
            <a href="#series" title="Series temporales"><span class="nav-icono">⌁</span><span class="nav-texto">Series temporales</span></a>
            <a href="#tendencia" title="Tendencia lineal"><span class="nav-icono">↗</span><span class="nav-texto">Tendencia lineal</span></a>
            <a href="/" title="Volver al juego"><span class="nav-icono">⌂</span><span class="nav-texto">Volver al juego</span></a>
        </nav>

    </aside>

    <main class="contenido">

        <header class="encabezado">
            <div class="encabezado-superior">
                <button type="button" id="btnMenu" class="btn-menu"
                        aria-label="Contraer menú" aria-expanded="true"
                        title="Contraer o expandir menú">
                    <span class="icono-menu">☰</span>
                </button>
                <div>
                    <h1>Panel de análisis estadístico</h1>
                    <p>Estudio matemático de los resultados generados en La Loto Estadística.</p>
                </div>
            </div>
        </header>

        <section id="resumen">

            <div class="tarjetas">

                <div class="tarjeta">
                    <p>Total de sorteos</p>
                    <h2 id="totalSorteos">0</h2>
                </div>

                <div class="tarjeta">
                    <p>Números diferentes</p>
                    <h2 id="numerosDiferentes">0</h2>
                </div>

                <div class="tarjeta">
                    <p>Números sin aparecer</p>
                    <h2 id="numerosSinAparecer">100</h2>
                </div>

                <div class="tarjeta">
                    <p>Probabilidad teórica</p>
                    <h2>1%</h2>
                </div>

            </div>

        </section>

        <section id="frecuencias" class="panel">

            <h3>Frecuencia absoluta por número</h3>

            <p class="descripcion">
                Cantidad de veces que ha aparecido cada número
                en el historial acumulado de sorteos.
            </p>

            <a href="/" class="boton">Realizar nuevo sorteo</a>

            <div class="grafico">
                <canvas id="graficoFrecuencias"></canvas>
            </div>
<h3 style="margin-top:35px;">
    Tabla de distribución de frecuencias
</h3>

<p class="descripcion">
    Frecuencia absoluta, relativa y porcentual de cada uno
    de los 100 números posibles.
</p>

<div class="tabla-contenedor">
    <table class="tabla-frecuencias">
        <thead>
            <tr>
                <th>Número</th>
                <th>Frecuencia absoluta</th>
                <th>Frecuencia relativa</th>
                <th>Porcentaje</th>
            </tr>
        </thead>

        <tbody id="tablaFrecuencias">
        </tbody>
    </table>
</div>

<div class="resumen-frecuencias">

    <div>
        <span>Total de frecuencias</span>
        <strong id="sumaAbsoluta">0</strong>
    </div>

    <div>
        <span>Suma de frecuencias relativas</span>
        <strong id="sumaRelativa">0</strong>
    </div>

    <div>
        <span>Suma de porcentajes</span>
        <strong id="sumaPorcentajes">0%</strong>
    </div>

</div>


            <p class="estado" id="estadoDatos">
                Cargando información estadística...
            </p>

        </section>

        <section id="distribucion" class="panel">

    <h3>Distribución de resultados por intervalos</h3>

    <p class="descripcion">
        Agrupación de los resultados en diez intervalos. Se compara la
        frecuencia observada de cada grupo con el 10 % de probabilidad teórica.
    </p>

    <div class="resumen-frecuencias">
        <div>
            <span>Total de sorteos analizados</span>
            <strong id="totalDistribucion">0</strong>
        </div>
        <div>
            <span>Intervalo con mayor frecuencia</span>
            <strong id="intervaloMayor">-</strong>
        </div>
        <div>
            <span>Frecuencia esperada por intervalo</span>
            <strong id="frecuenciaEsperada">0</strong>
        </div>
    </div>

    <h3 style="margin-top:30px;">Gráfico de distribución por intervalos</h3>
    <p class="descripcion">
        Las barras muestran la frecuencia observada y la línea representa
        el porcentaje teórico esperado del 10 % para cada intervalo.
    </p>

    <div class="grafico">
        <canvas id="graficoDistribucion"></canvas>
    </div>

    <h3 style="margin-top:30px;">Tabla de distribución agrupada</h3>

    <div class="tabla-contenedor">
        <table class="tabla-frecuencias">
            <thead>
                <tr>
                    <th>Intervalo</th>
                    <th>Frecuencia absoluta</th>
                    <th>Frecuencia relativa</th>
                    <th>Porcentaje observado</th>
                    <th>Porcentaje teórico</th>
                    <th>Diferencia</th>
                </tr>
            </thead>
            <tbody id="tablaDistribucion"></tbody>
        </table>
    </div>

    <div id="interpretacionDistribucion" class="conclusion-estadistica"
         style="margin-top:20px;">
        Cargando interpretación de la distribución...
    </div>

</section>

        
<section id="probabilidades" class="panel">

    <h3>Probabilidad teórica vs. observada</h3>

    <p class="descripcion">
        Comparación entre la probabilidad matemática esperada
        y el comportamiento real de los números sorteados.
    </p>

    <div class="resumen-frecuencias">

        <div>
            <span>Probabilidad teórica</span>
            <strong>1.00%</strong>
        </div>

        <div>
            <span>Probabilidad observada máxima</span>
            <strong id="probabilidadMaxima">0%</strong>
        </div>

        <div>
            <span>Total de sorteos analizados</span>
            <strong id="totalProbabilidad">0</strong>
        </div>

    </div>

    <h3 style="margin-top:30px;">
        Comparación por número
    </h3>

    <p class="descripcion">
        Las barras representan el porcentaje observado y la línea
        horizontal representa el 1% teórico.
    </p>

    <div class="grafico">
        <canvas id="graficoProbabilidades"></canvas>
    </div>

    <div class="tabla-contenedor">

        <table class="tabla-frecuencias">

            <thead>
                <tr>
                    <th>Número</th>
                    <th>Probabilidad teórica</th>
                    <th>Probabilidad observada</th>
                    <th>Diferencia</th>
                </tr>
            </thead>

            <tbody id="tablaProbabilidades"></tbody>

        </table>

    </div>
</section>

<section id="digitos" class="panel">

    <h3>Análisis estadístico de los dígitos</h3>

    <p class="descripcion">
        Estudio de la distribución de la primera y segunda
        cifra de todos los sorteos registrados.
    </p>

    <div class="bloque-digitos">

        <!-- PRIMERA CIFRA -->

        <div class="tarjeta-digito">

            <h3>Primera cifra</h3>

            <div class="indicadores-digito">

                <div class="indicador-digito">
                    <span>Media</span>
                    <strong id="mediaPrimera">0</strong>
                </div>

                <div class="indicador-digito">
                    <span>Mediana</span>
                    <strong id="medianaPrimera">0</strong>
                </div>

                <div class="indicador-digito">
                    <span>Moda</span>
                    <strong id="modaPrimera">-</strong>
                </div>

                <div class="indicador-digito">
                    <span>Desviación estándar</span>
                    <strong id="desviacionPrimera">0</strong>
                </div>

                <div class="indicador-digito">
               <span>Varianza</span>
    <strong id="varianzaPrimera">0</strong>
</div>



            </div>

            <div class="grafico-digito">
                <canvas id="graficoPrimeraCifra"></canvas>
            </div>

            <table class="tabla-digitos">
                <thead>
                    <tr>
                        <th>Dígito</th>
                        <th>Frecuencia</th>
                    </tr>
                </thead>
                <tbody id="tablaPrimeraCifra"></tbody>
            </table>

        </div>


        <!-- SEGUNDA CIFRA -->

        <div class="tarjeta-digito">

            <h3>Segunda cifra</h3>

            <div class="indicadores-digito">

                <div class="indicador-digito">
                    <span>Media</span>
                    <strong id="mediaSegunda">0</strong>
                </div>

                <div class="indicador-digito">
                    <span>Mediana</span>
                    <strong id="medianaSegunda">0</strong>
                </div>

                <div class="indicador-digito">
                    <span>Moda</span>
                    <strong id="modaSegunda">-</strong>
                </div>

                <div class="indicador-digito">
                    <span>Desviación estándar</span>
                    <strong id="desviacionSegunda">0</strong>
                </div>

                <div class="indicador-digito">
    <span>Varianza</span>
    <strong id="varianzaSegunda">0</strong>
</div>

            </div>

            <div class="grafico-digito">
                <canvas id="graficoSegundaCifra"></canvas>
            </div>

            <table class="tabla-digitos">
                <thead>
                    <tr>
                        <th>Dígito</th>
                        <th>Frecuencia</th>
                    </tr>
                </thead>
                <tbody id="tablaSegundaCifra"></tbody>
            </table>

        </div>

    </div>

    
<div class="tarjeta-digito tarjeta-completa">

    <h3>Análisis del número completo (00–99)</h3>

    <p class="descripcion">
        Medidas de dispersión y tendencia central de los
        valores numéricos de todos los resultados registrados.
    </p>

    <div class="indicadores-digito">

        <div class="indicador-digito">
            <span>Media</span>
            <strong id="mediaCompleta">0</strong>
        </div>

        <div class="indicador-digito">
            <span>Varianza</span>
            <strong id="varianzaCompleta">0</strong>
        </div>

        <div class="indicador-digito">
            <span>Desviación estándar</span>
            <strong id="desviacionCompleta">0</strong>
        </div>

    </div>

    <p class="descripcion">
        Nota: este análisis considera los resultados como valores
        numéricos para fines descriptivos y académicos.
    </p>

</div>

<div class="interpretacion-digitos">

    <h3>Interpretación de los resultados</h3>

    <p class="descripcion">
        Explicación automática de las medidas de estadística
        descriptiva obtenidas en los sorteos.
    </p>

    <div id="interpretacionPrimera"></div>

    <div id="interpretacionSegunda"></div>

    <div id="conclusionComparativa"></div>

</div>

</section>



      <section id="series" class="panel">
    <h3>Comportamiento a través del tiempo</h3>

    <p class="descripcion">
        Evolución de los resultados obtenidos en cada sorteo,
        según su orden cronológico.
    </p>

    <!-- Gráfica principal -->
    <div class="chart-container" style="height: 380px;">
        <canvas id="graficaSerieTemporal"></canvas>
    </div>

    <div id="resumenSerieTemporal"></div>

    <hr style="margin: 30px 0; border-color: #e2e8f0;">

    <h3>Comportamiento individual de las cifras</h3>

    <p class="descripcion">
        Observación de la primera y segunda cifra de cada número
        a lo largo de los sorteos registrados.
    </p>

    <div style="
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    ">
        <div>
            <h4>Primera cifra (decenas)</h4>
            <div class="chart-container" style="height: 300px;">
                <canvas id="graficaPrimeraCifraTemporal"></canvas>
            </div>
        </div>

        <div>
            <h4>Segunda cifra (unidades)</h4>
            <div class="chart-container" style="height: 300px;">
                <canvas id="graficaSegundaCifraTemporal"></canvas>
            </div>
        </div>
    </div>

    <div id="interpretacionCifrasTemporales"></div>
</section>

<section id="tendencia" class="panel">
    <h3>Tendencia lineal de los resultados</h3>
    <p class="descripcion">
        La línea muestra la orientación general de los resultados históricos
        según el orden en que se realizaron los sorteos.
    </p>

    <div class="resumen-frecuencias">
        <div>
            <span>Ecuación de tendencia</span>
            <strong id="ecuacionTendencia" style="font-size:16px;">-</strong>
        </div>
        <div>
            <span>Dirección de la tendencia</span>
            <strong id="direccionTendencia" style="font-size:16px;">-</strong>
        </div>
        <div>
            <span>Coeficiente de determinación (R²)</span>
            <strong id="r2Tendencia" style="font-size:16px;">-</strong>
        </div>
    </div>

    <div class="chart-container" style="height:340px; margin-top:20px;">
        <canvas id="graficaTendenciaLineal"></canvas>
    </div>

    <div id="interpretacionTendencia" class="conclusion-estadistica"
         style="margin-top:20px;">
        Cargando análisis de tendencia...
    </div>
</section>

    </main>

</div>

<script>
Chart.defaults.color = '#475569';
Chart.defaults.borderColor = '#e2e8f0';

let graficoFrecuencias = null;

async function cargarEstadisticas() {

    try {

        const respuesta = await fetch('/estadisticas/frecuencias');

        if (!respuesta.ok) {
            throw new Error('No se pudieron consultar las estadísticas.');
        }

        const datos = await respuesta.json();

        const frecuencias = datos.frecuencias;

        const total = Number(datos.total_sorteos);

        const diferentes = frecuencias.filter(
            item => Number(item.frecuencia_absoluta) > 0
        ).length;

        const sinAparecer = 100 - diferentes;

        document.getElementById('totalSorteos').textContent = total;

        document.getElementById('numerosDiferentes').textContent =
            diferentes;

        document.getElementById('numerosSinAparecer').textContent =
            sinAparecer;

        const etiquetas = frecuencias.map(item => item.numero);

        const valores = frecuencias.map(
            item => Number(item.frecuencia_absoluta)
        );
// Construcción de la tabla de frecuencias


// ========================================
// ANALISIS DE PROBABILIDADES
// ========================================

const tablaProb = document.getElementById('tablaProbabilidades');

tablaProb.innerHTML = '';

let probabilidadMaxima = 0;

const probabilidadesObservadas = frecuencias.map(item => {

    const absoluta = Number(item.frecuencia_absoluta);

    const observada = total > 0
        ? (absoluta / total) * 100
        : 0;

    const teorica = 1;

    const diferencia = observada - teorica;

    if (observada > probabilidadMaxima) {
        probabilidadMaxima = observada;
    }

    const fila = document.createElement('tr');

    fila.innerHTML = `
        <td class="numero-destacado">${item.numero}</td>
        <td>1.00%</td>
        <td>${observada.toFixed(2)}%</td>
        <td>${diferencia > 0 ? '+' : ''}${diferencia.toFixed(2)}%</td>
    `;

    tablaProb.appendChild(fila);

    return observada;

});

// Actualizar indicadores

document.getElementById('probabilidadMaxima').textContent =
    probabilidadMaxima.toFixed(2) + '%';

document.getElementById('totalProbabilidad').textContent = total;


// Crear gráfico comparativo

const contextoProb = document
    .getElementById('graficoProbabilidades')
    .getContext('2d');

if (window.graficoProbabilidades instanceof Chart) {
    window.graficoProbabilidades.destroy();
}

window.graficoProbabilidades = new Chart(contextoProb, {

    type: 'bar',

    data: {
        labels: frecuencias.map(item => item.numero),

        datasets: [

            {
                type: 'bar',
                label: 'Probabilidad observada (%)',
                data: probabilidadesObservadas,
                backgroundColor: '#3b82f6',
                borderRadius: 3
            },

            {
                type: 'line',
                label: 'Probabilidad teórica (1%)',
                data: frecuencias.map(() => 1),
                borderColor: '#f59e0b',
                backgroundColor: '#f59e0b',
                borderWidth: 2,
                pointRadius: 0,
                tension: 0
            }

        ]
    },

    options: {

        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                labels: {
                    color: '#334155'
                }
            }
        },

        scales: {

            x: {
                ticks: {
                    color: '#64748b',
                    maxRotation: 90,
                    minRotation: 90,
                    autoSkip: false,
                    font: { size: 9 }
                },
                grid: {
                    color: '#e2e8f0'
                }
            },

            y: {
                beginAtZero: true,
                ticks: {
                    color: '#64748b',
                    callback: value => value + '%'
                },
                grid: {
                    color: '#e2e8f0'
                }
            }

        }

    }

});



const tabla = document.getElementById('tablaFrecuencias');

tabla.innerHTML = '';

let sumaAbsoluta = 0;
let sumaRelativa = 0;
let sumaPorcentajes = 0;

frecuencias.forEach(item => {

    const absoluta = Number(item.frecuencia_absoluta);

    // Frecuencia relativa
    const relativa = total > 0 ? absoluta / total : 0;

    // Porcentaje observado
    const porcentaje = relativa * 100;

    sumaAbsoluta += absoluta;
    sumaRelativa += relativa;
    sumaPorcentajes += porcentaje;

    const fila = document.createElement('tr');

    fila.innerHTML = `
        <td class="numero-destacado">${item.numero}</td>
        <td>${absoluta}</td>
        <td>${relativa.toFixed(4)}</td>
        <td>${porcentaje.toFixed(2)}%</td>
    `;

    tabla.appendChild(fila);

});

// Mostrar totales

document.getElementById('sumaAbsoluta').textContent =
    sumaAbsoluta;

document.getElementById('sumaRelativa').textContent =
    sumaRelativa.toFixed(4);

document.getElementById('sumaPorcentajes').textContent =
    sumaPorcentajes.toFixed(2) + '%';
        const contexto = document
            .getElementById('graficoFrecuencias')
            .getContext('2d');

        if (graficoFrecuencias) {
            graficoFrecuencias.destroy();
        }

        graficoFrecuencias = new Chart(contexto, {

            type: 'bar',

            data: {
                labels: etiquetas,

                datasets: [{
                    label: 'Frecuencia absoluta',
                    data: valores,
                    backgroundColor: '#3b82f6',
                    borderRadius: 3
                }]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        labels: {
                            color: '#334155'
                        }
                    }
                },

                scales: {

                    x: {
                        ticks: {
                            color: '#64748b',
                            maxRotation: 90,
                            minRotation: 90,
                            autoSkip: false,
                            font: {
                                size: 9
                            }
                        },
                        grid: {
                            color: '#e2e8f0'
                        }
                    },

                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            color: '#64748b'
                        },
                        grid: {
                            color: '#e2e8f0'
                        }
                    }

                }

            }

        });

        document.getElementById('estadoDatos').textContent =
            'Información actualizada correctamente. ' +
            'Se analizaron ' + total + ' sorteos y 100 números posibles.';

    } catch (error) {

        document.getElementById('estadoDatos').textContent =
            'Error al cargar los datos: ' + error.message;

    }

}


async function cargarAnalisisDigitos() {

    try {

        const respuesta = await fetch('/estadisticas/analisis-digitos');

        if (!respuesta.ok) {
            throw new Error('No se pudo cargar el análisis de dígitos.');
        }

        const datos = await respuesta.json();

        function mostrarPosicion(tipo, prefijo, canvasId, tablaId) {

            const estadistica = datos[tipo];

            document.getElementById('media' + prefijo).textContent =
                Number(estadistica.media).toFixed(4);

            document.getElementById('mediana' + prefijo).textContent =
                estadistica.mediana;

            document.getElementById('moda' + prefijo).textContent =
                estadistica.moda.length > 0
                    ? estadistica.moda.join(', ')
                    : 'Sin moda';

            document.getElementById('desviacion' + prefijo).textContent =
                Number(estadistica.desviacion_estandar).toFixed(4);

            document.getElementById('varianza' + prefijo).textContent =
                Number(estadistica.varianza).toFixed(4);

            const frecuencias = estadistica.frecuencias;

            const tabla = document.getElementById(tablaId);

            tabla.innerHTML = '';

            frecuencias.forEach((cantidad, digito) => {

                const fila = document.createElement('tr');

                fila.innerHTML = `
                    <td>${digito}</td>
                    <td>${cantidad}</td>
                `;

                tabla.appendChild(fila);

            });

            const contexto = document
                .getElementById(canvasId)
                .getContext('2d');

            const nombreGrafico = canvasId;

            if (window[nombreGrafico] instanceof Chart) {
                window[nombreGrafico].destroy();
            }

            window[nombreGrafico] = new Chart(contexto, {

                type: 'bar',

                data: {

                    labels: ['0','1','2','3','4','5','6','7','8','9'],

                    datasets: [{
                        label: 'Frecuencia absoluta',
                        data: frecuencias,
                        backgroundColor: '#3b82f6',
                        borderRadius: 5
                    }]

                },

                options: {

                    responsive: true,
                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            labels: {
                                color: '#334155'
                            }
                        }
                    },

                    scales: {

                        x: {
                            ticks: {
                                color: '#64748b'
                            },
                            grid: {
                                color: '#e2e8f0'
                            }
                        },

                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                color: '#64748b'
                            },
                            grid: {
                                color: '#e2e8f0'
                            }
                        }

                    }

                }

            });

        }

        mostrarPosicion(
            'primera_cifra',
            'Primera',
            'graficoPrimeraCifra',
            'tablaPrimeraCifra'
        );

        mostrarPosicion(
            'segunda_cifra',
            'Segunda',
            'graficoSegundaCifra',
            'tablaSegundaCifra'
        );

        // Estadísticas del número completo (00–99).
        const completo = datos.numero_completo;

        document.getElementById('mediaCompleta').textContent =
            Number(completo.media).toFixed(4);

        document.getElementById('varianzaCompleta').textContent =
            Number(completo.varianza).toFixed(4);

        document.getElementById('desviacionCompleta').textContent =
            Number(completo.desviacion_estandar).toFixed(4);


function interpretarPosicion(estadistica, nombre) {

    const total = estadistica.total;
    const media = Number(estadistica.media);
    const mediana = Number(estadistica.mediana);
    const varianza = Number(estadistica.varianza);
    const desviacion = Number(estadistica.desviacion_estandar);

    if (total === 0) {
        return `
            <div class="interpretacion-bloque">
                <h4>${nombre}</h4>
                <p>No existen sorteos registrados para realizar el análisis.</p>
            </div>
        `;
    }

    const frecuencias = estadistica.frecuencias;
    const frecuenciaMaxima = Math.max(...frecuencias);

    let textoModa = '';

    if (frecuenciaMaxima <= 1) {
        textoModa = 'No existe moda, porque ningún dígito se repite.';
    } else if (estadistica.moda.length === 1) {
        textoModa = `La moda es el dígito ${estadistica.moda[0]}, 
                     que aparece ${frecuenciaMaxima} veces.`;
    } else {
        textoModa = `La distribución es multimodal. Los dígitos 
                     ${estadistica.moda.join(', ')} comparten la 
                     frecuencia máxima de ${frecuenciaMaxima} apariciones.`;
    }

    return `
        <div class="interpretacion-bloque">

            <h4>${nombre}</h4>

            <p>
                <strong>Media:</strong>
                El promedio de los dígitos es ${media.toFixed(4)}.
            </p>

            <p>
                <strong>Mediana:</strong>
                El valor central de los datos ordenados es
                ${mediana.toFixed(4)}.
            </p>

            <p>
                <strong>Moda:</strong>
                ${textoModa}
            </p>

            <p>
                <strong>Varianza:</strong>
                El valor de ${varianza.toFixed(4)} representa el promedio
                de las desviaciones cuadráticas respecto a la media.
            </p>

            <p>
                <strong>Desviación estándar:</strong>
                El valor de ${desviacion.toFixed(4)} representa
                la dispersión de los dígitos respecto a su media.
            </p>

            <p>
                <strong>Registros analizados:</strong>
                ${total} sorteos.
            </p>

        </div>
    `;
}


// Generar interpretaciones individuales

document.getElementById('interpretacionPrimera').innerHTML =
    interpretarPosicion(datos.primera_cifra, 'Primera cifra');

document.getElementById('interpretacionSegunda').innerHTML =
    interpretarPosicion(datos.segunda_cifra, 'Segunda cifra');


// Comparación de las desviaciones estándar

const desviacionPrimera =
    Number(datos.primera_cifra.desviacion_estandar);

const desviacionSegunda =
    Number(datos.segunda_cifra.desviacion_estandar);

let comparacion = '';

if (desviacionPrimera > desviacionSegunda) {

    comparacion = 'La primera cifra presenta mayor dispersión ' +
        'que la segunda cifra en los sorteos analizados.';

} else if (desviacionSegunda > desviacionPrimera) {

    comparacion = 'La segunda cifra presenta mayor dispersión ' +
        'que la primera cifra en los sorteos analizados.';

} else {

    comparacion = 'Ambas posiciones presentan la misma desviación ' +
        'estándar en los sorteos analizados.';

}

document.getElementById('conclusionComparativa').innerHTML = `
    <div class="conclusion-estadistica">
        <strong>Conclusión comparativa</strong>
        <p>${comparacion}</p>
        <p>
            Esta comparación describe los datos históricos registrados
            y no permite predecir los resultados de próximos sorteos.
        </p>
    </div>
`;



    } catch (error) {

        console.error('Error en análisis de dígitos:', error);

    }

}

async function cargarDistribucion() {
    try {
        const respuesta = await fetch('/estadisticas/distribucion');

        if (!respuesta.ok) {
            throw new Error('No se pudo cargar la distribución por intervalos.');
        }

        const datos = await respuesta.json();
        const intervalos = datos.intervalos || [];
        const total = Number(datos.total_sorteos || 0);

        document.getElementById('totalDistribucion').textContent = total;
        document.getElementById('frecuenciaEsperada').textContent =
            Number(datos.frecuencia_esperada || 0).toFixed(2);

        const tabla = document.getElementById('tablaDistribucion');
        tabla.innerHTML = '';

        intervalos.forEach(item => {
            const diferencia = Number(item.diferencia);
            const fila = document.createElement('tr');

            fila.innerHTML = `
                <td class="numero-destacado">${item.intervalo}</td>
                <td>${Number(item.frecuencia_absoluta)}</td>
                <td>${Number(item.frecuencia_relativa).toFixed(4)}</td>
                <td>${Number(item.porcentaje).toFixed(2)}%</td>
                <td>${Number(item.porcentaje_teorico).toFixed(2)}%</td>
                <td>${diferencia > 0 ? '+' : ''}${diferencia.toFixed(2)}%</td>
            `;

            tabla.appendChild(fila);
        });

        const contexto = document
            .getElementById('graficoDistribucion')
            .getContext('2d');

        if (window.graficoDistribucion instanceof Chart) {
            window.graficoDistribucion.destroy();
        }

        window.graficoDistribucion = new Chart(contexto, {
            type: 'bar',
            data: {
                labels: intervalos.map(item => item.intervalo),
                datasets: [
                    {
                        type: 'bar',
                        label: 'Porcentaje observado',
                        data: intervalos.map(item => Number(item.porcentaje)),
                        backgroundColor: '#3b82f6',
                        borderRadius: 5
                    },
                    {
                        type: 'line',
                        label: 'Porcentaje teórico (10%)',
                        data: intervalos.map(() => 10),
                        borderColor: '#f59e0b',
                        backgroundColor: '#f59e0b',
                        borderWidth: 2,
                        pointRadius: 3,
                        tension: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: { color: '#334155' }
                    },
                    tooltip: {
                        callbacks: {
                            label: context => context.dataset.label + ': ' +
                                Number(context.parsed.y).toFixed(2) + '%'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: '#64748b' },
                        grid: { color: '#e2e8f0' }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#64748b',
                            callback: value => value + '%'
                        },
                        grid: { color: '#e2e8f0' }
                    }
                }
            }
        });

        if (total === 0) {
            document.getElementById('intervaloMayor').textContent = '-';
            document.getElementById('interpretacionDistribucion').innerHTML =
                '<strong>Interpretación:</strong> todavía no existen sorteos registrados.';
            return;
        }

        const frecuenciaMaxima = Math.max(
            ...intervalos.map(item => Number(item.frecuencia_absoluta))
        );

        const intervalosMayores = intervalos
            .filter(item => Number(item.frecuencia_absoluta) === frecuenciaMaxima)
            .map(item => item.intervalo);

        document.getElementById('intervaloMayor').textContent =
            intervalosMayores.join(', ');

        const porcentajeMaximo = Math.max(
            ...intervalos.map(item => Number(item.porcentaje))
        );
        const porcentajeMinimo = Math.min(
            ...intervalos.map(item => Number(item.porcentaje))
        );

        const intervalosMenores = intervalos
            .filter(item => Number(item.porcentaje) === porcentajeMinimo)
            .map(item => item.intervalo);

        const textoMayor = intervalosMayores.length === 1
            ? `El intervalo ${intervalosMayores[0]}`
            : `Los intervalos ${intervalosMayores.join(', ')}`;

        const textoMenor = intervalosMenores.length === 1
            ? `El intervalo ${intervalosMenores[0]}`
            : `Los intervalos ${intervalosMenores.join(', ')}`;

        document.getElementById('interpretacionDistribucion').innerHTML = `
            <strong>Interpretación de la distribución</strong>
            <p style="margin-top:8px;">
                ${textoMayor} presentó la mayor frecuencia, con
                ${frecuenciaMaxima} apariciones (${porcentajeMaximo.toFixed(2)}%).
                ${textoMenor} registró la menor participación,
                con ${porcentajeMinimo.toFixed(2)}%.
            </p>
            <p style="margin-top:8px;">
                Si los 100 resultados tienen la misma probabilidad teórica,
                cada intervalo agrupa diez resultados posibles y representa
                un 10% de probabilidad. Las diferencias observadas describen
                la muestra registrada y pueden ocurrir por variación aleatoria;
                no permiten anticipar los próximos sorteos.
            </p>
        `;

    } catch (error) {
        console.error('Error al cargar la distribución:', error);
        document.getElementById('interpretacionDistribucion').textContent =
            'No fue posible cargar la distribución. Revise la consola del navegador.';
    }
}

async function cargarSerieTemporal() {
    try {
        const respuesta = await fetch('/estadisticas/serie-temporal');
        if (!respuesta.ok) {
            throw new Error('No se pudieron consultar los sorteos.');
        }

        const datos = await respuesta.json();
        const sorteos = datos.serie_temporal || [];
        const etiquetas = sorteos.map(s => s.orden);
        const numeros = sorteos.map(s => Number(s.numero));

        // Gráfica principal: resultados completos del 00 al 99.
        new Chart(document.getElementById('graficaSerieTemporal'), {
            type: 'line',
            data: {
                labels: etiquetas,
                datasets: [{
                    label: 'Número obtenido',
                    data: numeros,
                    borderColor: '#38bdf8',
                    backgroundColor: 'rgba(56, 189, 248, 0.15)',
                    borderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { labels: { color: '#475569' } },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const sorteo = sorteos[context.dataIndex];
                                return 'Número: ' + sorteo.numero +
                                    ' | Fecha: ' + sorteo.fecha;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Orden del sorteo',
                            color: '#475569'
                        },
                        ticks: { color: '#475569' },
                        grid: { color: '#e2e8f0' }
                    },
                    y: {
                        min: 0,
                        max: 99,
                        title: {
                            display: true,
                            text: 'Número obtenido (00–99)',
                            color: '#475569'
                        },
                        ticks: { color: '#475569', stepSize: 10 },
                        grid: { color: '#e2e8f0' }
                    }
                }
            }
        });

        const primeraCifra = sorteos.map(s => Number(s.primera_cifra));
        const segundaCifra = sorteos.map(s => Number(s.segunda_cifra));

        const opcionesCifras = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { labels: { color: '#475569' } },
                tooltip: {
                    callbacks: {
                        label: context => 'Dígito: ' + context.parsed.y
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Orden del sorteo',
                        color: '#475569'
                    },
                    ticks: { color: '#475569', maxTicksLimit: 15 },
                    grid: { color: '#e2e8f0' }
                },
                y: {
                    min: 0,
                    max: 9,
                    ticks: { stepSize: 1, color: '#475569' },
                    title: {
                        display: true,
                        text: 'Dígito (0–9)',
                        color: '#475569'
                    },
                    grid: { color: '#e2e8f0' }
                }
            }
        };

        // Gráfica de primera cifra (decenas).
        new Chart(document.getElementById('graficaPrimeraCifraTemporal'), {
            type: 'line',
            data: {
                labels: etiquetas,
                datasets: [{
                    label: 'Primera cifra (decenas)',
                    data: primeraCifra,
                    borderColor: '#38bdf8',
                    backgroundColor: 'rgba(56, 189, 248, 0.15)',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.2,
                    fill: true
                }]
            },
            options: opcionesCifras
        });

        // Gráfica de segunda cifra (unidades).
        new Chart(document.getElementById('graficaSegundaCifraTemporal'), {
            type: 'line',
            data: {
                labels: etiquetas,
                datasets: [{
                    label: 'Segunda cifra (unidades)',
                    data: segundaCifra,
                    borderColor: '#a78bfa',
                    backgroundColor: 'rgba(167, 139, 250, 0.15)',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.2,
                    fill: true
                }]
            },
            options: opcionesCifras
        });

        document.getElementById('resumenSerieTemporal').innerHTML = `
            <p class="descripcion" style="margin-top:20px;">
                Se analizaron <strong>${datos.total_sorteos}</strong> sorteos.
                La gráfica representa la secuencia de resultados registrados.
                Cada sorteo es independiente; por tanto, esta visualización
                describe los resultados históricos y no permite predecir
                resultados futuros.
            </p>
        `;

        document.getElementById('interpretacionCifrasTemporales').innerHTML = `
            <div class="conclusion-estadistica" style="margin-top:20px;">
                <strong>¿Cómo interpretar estas gráficas?</strong>
                <p>
                    La primera gráfica inferior muestra el dígito de las
                    decenas y la segunda muestra el dígito de las unidades
                    de cada resultado. El eje horizontal representa el orden
                    de los sorteos y el eje vertical identifica el dígito
                    obtenido, de 0 a 9. Las variaciones son descriptivas:
                    no constituyen una tendencia predictiva.
                </p>
            </div>
        `;

    } catch (error) {
        console.error('Error al cargar la serie temporal:', error);
        const resumen = document.getElementById('resumenSerieTemporal');
        if (resumen) {
            resumen.textContent =
                'No fue posible cargar la serie temporal. Revise la consola del navegador.';
        }
    }
}

async function cargarTendenciaLineal() {
    try {
        const respuesta = await fetch('/estadisticas/serie-temporal');

        if (!respuesta.ok) {
            throw new Error('No se pudo consultar la serie histórica.');
        }

        const datos = await respuesta.json();
        const sorteos = datos.serie_temporal || [];
        const total = sorteos.length;

        const ecuacion = document.getElementById('ecuacionTendencia');
        const direccion = document.getElementById('direccionTendencia');
        const r2Elemento = document.getElementById('r2Tendencia');
        const interpretacion = document.getElementById('interpretacionTendencia');

        if (total < 2) {
            ecuacion.textContent = 'Datos insuficientes';
            direccion.textContent = '-';
            r2Elemento.textContent = '-';
            interpretacion.textContent =
                'Se necesitan al menos dos sorteos para calcular una tendencia lineal.';
            return;
        }

        // X representa el orden del sorteo y Y el resultado numérico 00–99.
        const puntos = sorteos.map((sorteo, indice) => ({
            x: indice + 1,
            y: Number(sorteo.numero)
        }));

        const promedioX = puntos.reduce((suma, punto) => suma + punto.x, 0) / total;
        const promedioY = puntos.reduce((suma, punto) => suma + punto.y, 0) / total;

        let numerador = 0;
        let denominador = 0;

        puntos.forEach(punto => {
            numerador += (punto.x - promedioX) * (punto.y - promedioY);
            denominador += (punto.x - promedioX) ** 2;
        });

        const pendiente = denominador === 0 ? 0 : numerador / denominador;
        const intercepto = promedioY - pendiente * promedioX;

        const predichos = puntos.map(punto => intercepto + pendiente * punto.x);

        const sumaErrores = puntos.reduce(
            (suma, punto, indice) => suma + (punto.y - predichos[indice]) ** 2,
            0
        );
        const sumaTotal = puntos.reduce(
            (suma, punto) => suma + (punto.y - promedioY) ** 2,
            0
        );

        const r2 = sumaTotal === 0
            ? 1
            : Math.max(0, Math.min(1, 1 - (sumaErrores / sumaTotal)));

        const signo = intercepto >= 0 ? '+' : '-';
        ecuacion.textContent =
            `Y = ${pendiente.toFixed(4)}X ${signo} ${Math.abs(intercepto).toFixed(4)}`;

        let textoDireccion = 'Sin inclinación';
        if (pendiente > 0.000001) {
            textoDireccion = 'Ascendente';
        } else if (pendiente < -0.000001) {
            textoDireccion = 'Descendente';
        }

        direccion.textContent = textoDireccion;
        r2Elemento.textContent = r2.toFixed(4);

        if (window.graficaTendenciaLineal instanceof Chart) {
            window.graficaTendenciaLineal.destroy();
        }

        const contexto = document
            .getElementById('graficaTendenciaLineal')
            .getContext('2d');

        window.graficaTendenciaLineal = new Chart(contexto, {
            type: 'line',
            data: {
                labels: puntos.map(punto => punto.x),
                datasets: [
                    {
                        label: 'Resultados históricos',
                        data: puntos.map(punto => punto.y),
                        borderColor: '#38bdf8',
                        backgroundColor: 'rgba(56, 189, 248, 0.15)',
                        pointRadius: 4,
                        borderWidth: 2,
                        tension: 0.15
                    },
                    {
                        label: 'Tendencia lineal',
                        data: predichos,
                        borderColor: '#f59e0b',
                        backgroundColor: '#f59e0b',
                        pointRadius: 0,
                        borderWidth: 3,
                        borderDash: [7, 5],
                        tension: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: { color: '#334155' }
                    },
                    tooltip: {
                        callbacks: {
                            label: context =>
                                context.dataset.label + ': ' +
                                Number(context.parsed.y).toFixed(2)
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Orden del sorteo',
                            color: '#334155'
                        },
                        ticks: { color: '#64748b' },
                        grid: { color: '#e2e8f0' }
                    },
                    y: {
                        min: 0,
                        max: 99,
                        title: {
                            display: true,
                            text: 'Resultado (00–99)',
                            color: '#334155'
                        },
                        ticks: { color: '#64748b' },
                        grid: { color: '#e2e8f0' }
                    }
                }
            }
        });

        const sentidoTexto = pendiente > 0
            ? 'ascendente'
            : pendiente < 0
                ? 'descendente'
                : 'prácticamente horizontal';

        interpretacion.innerHTML = `
            <strong>¿Cómo interpretar este resultado?</strong>
            <p style="margin-top:8px;">
                La tendencia calculada es ${sentidoTexto}. La pendiente es
                ${pendiente.toFixed(4)}, lo que describe el cambio promedio
                de la recta por cada sorteo registrado.
            </p>
            <p style="margin-top:8px;">
                El R² es ${r2.toFixed(4)} y expresa qué proporción de la
                variación histórica queda representada por esta recta.
                Este indicador describe el ajuste del modelo a los datos
                observados, no su capacidad para anticipar resultados futuros.
            </p>
            <p style="margin-top:8px;">
                <strong>Importante:</strong> los sorteos son independientes.
                La tendencia lineal es una herramienta descriptiva y académica;
                no permite predecir el número del próximo sorteo.
            </p>
        `;

    } catch (error) {
        console.error('Error al calcular la tendencia lineal:', error);
        document.getElementById('interpretacionTendencia').textContent =
            'No fue posible calcular la tendencia lineal. Revise la consola del navegador.';
    }
}

cargarAnalisisDigitos();

cargarDistribucion();

cargarEstadisticas();

cargarSerieTemporal();

cargarTendenciaLineal();



// Control del menú lateral: conserva la preferencia durante la navegación.
(function () {
    const contenedor = document.querySelector('.contenedor');
    const botonMenu = document.getElementById('btnMenu');
    if (!contenedor || !botonMenu) return;

    const clave = 'lotoEstadisticaMenuColapsado';
    const aplicarEstado = (colapsado) => {
        contenedor.classList.toggle('menu-colapsado', colapsado);
        botonMenu.setAttribute('aria-expanded', String(!colapsado));
        botonMenu.setAttribute(
            'aria-label',
            colapsado ? 'Expandir menú' : 'Contraer menú'
        );
        botonMenu.title = colapsado ? 'Expandir menú' : 'Contraer menú';
    };

    let estadoInicial = false;
    try {
        estadoInicial = localStorage.getItem(clave) === 'true';
    } catch (e) {
        // El menú sigue funcionando aunque el navegador bloquee el almacenamiento.
    }
    aplicarEstado(estadoInicial);

    botonMenu.addEventListener('click', () => {
        const nuevoEstado = !contenedor.classList.contains('menu-colapsado');
        aplicarEstado(nuevoEstado);
        try {
            localStorage.setItem(clave, String(nuevoEstado));
        } catch (e) {
            // Sin almacenamiento persistente, el cambio permanece en esta página.
        }
    });
})();

</script>

</body>
</html>
