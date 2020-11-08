--
-- ER/Studio 8.0 SQL Code Generation
-- Company :      HP Inc.
-- Project :      sistema facturacion.DM1
-- Author :       mclanghlin@outlook.com
--
-- Date Created : Saturday, October 24, 2020 15:49:25
-- Target DBMS : PostgreSQL 8.0
--

-- 
-- TABLE: categoria 
--

CREATE TABLE categoria(
    id_categoria       serial         NOT NULL,
    "nombreCategoria"  varchar(100),
    CONSTRAINT "PK34" PRIMARY KEY (id_categoria)
)
;



-- 
-- TABLE: cliente 
--

CREATE TABLE cliente(
    id_persona        serial         NOT NULL,
    apellidos         varchar(100),
    ruc               varchar(100),
    email             varchar(100),
    "numeroTelefono"  varchar(100),
    nombre            varchar(100)    NOT NULL,
    CONSTRAINT "PK13" PRIMARY KEY (id_persona)
)
;



-- 
-- TABLE: descuento 
--

CREATE TABLE descuento(
    id_descuento    serial        NOT NULL,
    id_producto     int4           NOT NULL,
    id_marca        int4           NOT NULL,
    id_categoria    int4           NOT NULL,
    "fechaLimite"   date,
    decuento        varchar(20)    NOT NULL,
    CONSTRAINT "PK40" PRIMARY KEY (id_descuento, id_producto, id_marca, id_categoria)
)
;



-- 
-- TABLE: factura 
--

CREATE TABLE factura(
    numero_factura    serial         NOT NULL,
    id_persona        int4            NOT NULL,
    tipo              varchar(100),
    fecha             timestamp       NOT NULL,
    CONSTRAINT "PK21" PRIMARY KEY (numero_factura)
)
;



-- 
-- TABLE: factura_detalle 
--

CREATE TABLE factura_detalle(
    id_detatlle       serial         NOT NULL,
    numero_factura    int4            NOT NULL,
    "numeroDetalle"   varchar(100)    NOT NULL,
    precio            float4          NOT NULL,
    cantidad          float4,
    CONSTRAINT "PK33" PRIMARY KEY (id_detatlle)
)
;



-- 
-- TABLE: marca 
--

CREATE TABLE marca(
    id_marca        serial         NOT NULL,
    id_categoria    int4            NOT NULL,
    "nombreMarca"   varchar(100),
    CONSTRAINT "PK39" PRIMARY KEY (id_marca, id_categoria)
)
;



-- 
-- TABLE: modo_pago 
--

CREATE TABLE modo_pago(
    id_modo_pago    integer    NOT NULL,
    CONSTRAINT "PK37" PRIMARY KEY (id_modo_pago)
)
;



-- 
-- TABLE: producto 
--

CREATE TABLE producto(
    id_producto     serial            NOT NULL,
    id_marca        int4               NOT NULL,
    id_categoria    int4               NOT NULL,
    estado          boolean,
    codigo          varchar(50)        NOT NULL,
    "codigoBarra"   varchar(40)        NOT NULL,
    stock           int4               NOT NULL,
    precio          decimal(100, 0),
    CONSTRAINT "PK22" PRIMARY KEY (id_producto, id_marca, id_categoria)
)
;



-- 
-- TABLE: descuento 
--

ALTER TABLE descuento ADD CONSTRAINT "Refproducto38" 
    FOREIGN KEY (id_producto, id_marca, id_categoria)
    REFERENCES producto(id_producto, id_marca, id_categoria)
;


-- 
-- TABLE: factura 
--

ALTER TABLE factura ADD CONSTRAINT "Refcliente28" 
    FOREIGN KEY (id_persona)
    REFERENCES cliente(id_persona)
;


-- 
-- TABLE: factura_detalle 
--

ALTER TABLE factura_detalle ADD CONSTRAINT "Reffactura29" 
    FOREIGN KEY (numero_factura)
    REFERENCES factura(numero_factura)
;


-- 
-- TABLE: marca 
--

ALTER TABLE marca ADD CONSTRAINT "Refcategoria36" 
    FOREIGN KEY (id_categoria)
    REFERENCES categoria(id_categoria)
;


-- 
-- TABLE: producto 
--

ALTER TABLE producto ADD CONSTRAINT "Refmarca33" 
    FOREIGN KEY (id_marca, id_categoria)
    REFERENCES marca(id_marca, id_categoria)
;


