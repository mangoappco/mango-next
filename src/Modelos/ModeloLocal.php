<?php

declare(strict_types=1);

namespace Mango\Modelos;

use PDO;

final class ModeloLocal
{
    public function __construct(private PDO $connection)
    {
    }

    public function buscarMarcas(): array
    {
        $statement = $this->connection->query(
            'SELECT id, nombre, slug
             FROM marcas
             WHERE activo = 1
             ORDER BY nombre ASC'
        );

        return $statement->fetchAll();
    }

    public function buscarMarcaActivaPorId(int $id): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT id, nombre, slug
             FROM marcas
             WHERE id = :id
               AND activo = 1
             LIMIT 1'
        );
        $statement->execute(['id' => $id]);
        $marca = $statement->fetch();

        return $marca === false ? null : $marca;
    }

    public function buscarTodos(string $busqueda = ''): array
    {
        $sql = 'SELECT l.id, l.marca_id, m.nombre AS marca_nombre, m.slug AS marca_slug,
                       l.codigo, l.nombre, l.direccion, l.telefono, l.ciudad, l.barrio,
                       l.tipo_local, l.apertura, l.cierre, l.propina_porcentaje,
                       l.imagen, l.activo, l.creado_en, l.actualizado_en
                FROM locales AS l
                INNER JOIN marcas AS m ON m.id = l.marca_id';

        $parametros = [];

        if ($busqueda !== '') {
            $sql .= ' WHERE l.codigo LIKE :busqueda_codigo
                      OR l.nombre LIKE :busqueda_nombre
                      OR l.direccion LIKE :busqueda_direccion
                      OR l.ciudad LIKE :busqueda_ciudad
                      OR l.barrio LIKE :busqueda_barrio
                      OR l.tipo_local LIKE :busqueda_tipo
                      OR m.nombre LIKE :busqueda_marca';

            $valorBusqueda = '%' . $busqueda . '%';
            $parametros = [
                'busqueda_codigo' => $valorBusqueda,
                'busqueda_nombre' => $valorBusqueda,
                'busqueda_direccion' => $valorBusqueda,
                'busqueda_ciudad' => $valorBusqueda,
                'busqueda_barrio' => $valorBusqueda,
                'busqueda_tipo' => $valorBusqueda,
                'busqueda_marca' => $valorBusqueda,
            ];
        }

        $sql .= ' ORDER BY l.id DESC';

        $statement = $this->connection->prepare($sql);
        $statement->execute($parametros);

        return $statement->fetchAll();
    }

    public function buscarPorId(int $id): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT l.id, l.marca_id, m.nombre AS marca_nombre, m.slug AS marca_slug,
                   l.codigo, l.nombre, l.direccion, l.telefono, l.ciudad, l.barrio,
                   l.tipo_local, l.apertura, l.cierre, l.propina_porcentaje,
                   l.imagen, l.activo, l.creado_en, l.actualizado_en
             FROM locales AS l
             INNER JOIN marcas AS m ON m.id = l.marca_id
             WHERE l.id = :id
             LIMIT 1'
        );
        $statement->execute(['id' => $id]);
        $local = $statement->fetch();

        return $local === false ? null : $local;
    }

    public function codigoExiste(string $codigo, ?int $idExcluir = null): bool
    {
        $sql = 'SELECT COUNT(*) FROM locales WHERE codigo = :codigo';
        $parametros = ['codigo' => $codigo];

        if ($idExcluir !== null) {
            $sql .= ' AND id <> :id_excluir';
            $parametros['id_excluir'] = $idExcluir;
        }

        $statement = $this->connection->prepare($sql);
        $statement->execute($parametros);

        return (int) $statement->fetchColumn() > 0;
    }

    public function crear(
        int $marcaId,
        ?string $codigo,
        string $nombre,
        string $direccion,
        ?string $telefono,
        ?string $ciudad,
        ?string $barrio,
        string $tipoLocal,
        ?string $apertura,
        ?string $cierre,
        float $propinaPorcentaje,
        ?string $imagen
    ): int {
        $statement = $this->connection->prepare(
            'INSERT INTO locales
                (marca_id, codigo, nombre, direccion, telefono, ciudad, barrio, tipo_local,
                 apertura, cierre, propina_porcentaje, imagen)
             VALUES
                (:marca_id, :codigo, :nombre, :direccion, :telefono, :ciudad, :barrio, :tipo_local,
                 :apertura, :cierre, :propina_porcentaje, :imagen)'
        );
        $statement->execute([
            'marca_id' => $marcaId,
            'codigo' => $codigo,
            'nombre' => $nombre,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'ciudad' => $ciudad,
            'barrio' => $barrio,
            'tipo_local' => $tipoLocal,
            'apertura' => $apertura,
            'cierre' => $cierre,
            'propina_porcentaje' => $propinaPorcentaje,
            'imagen' => $imagen,
        ]);

        return (int) $this->connection->lastInsertId();
    }

    public function actualizar(
        int $id,
        int $marcaId,
        ?string $codigo,
        string $nombre,
        string $direccion,
        ?string $telefono,
        ?string $ciudad,
        ?string $barrio,
        string $tipoLocal,
        ?string $apertura,
        ?string $cierre,
        float $propinaPorcentaje,
        ?string $imagen
    ): void {
        $statement = $this->connection->prepare(
            'UPDATE locales
             SET marca_id = :marca_id,
                 codigo = :codigo,
                 nombre = :nombre,
                 direccion = :direccion,
                 telefono = :telefono,
                 ciudad = :ciudad,
                 barrio = :barrio,
                 tipo_local = :tipo_local,
                 apertura = :apertura,
                 cierre = :cierre,
                 propina_porcentaje = :propina_porcentaje,
                 imagen = :imagen
             WHERE id = :id'
        );
        $statement->execute([
            'id' => $id,
            'marca_id' => $marcaId,
            'codigo' => $codigo,
            'nombre' => $nombre,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'ciudad' => $ciudad,
            'barrio' => $barrio,
            'tipo_local' => $tipoLocal,
            'apertura' => $apertura,
            'cierre' => $cierre,
            'propina_porcentaje' => $propinaPorcentaje,
            'imagen' => $imagen,
        ]);
    }

    public function desactivar(int $id): void
    {
        $statement = $this->connection->prepare(
            'UPDATE locales
             SET activo = 0
             WHERE id = :id'
        );
        $statement->execute(['id' => $id]);
    }

    public function reactivar(int $id): void
    {
        $statement = $this->connection->prepare(
            'UPDATE locales
             SET activo = 1
             WHERE id = :id'
        );
        $statement->execute(['id' => $id]);
    }
}