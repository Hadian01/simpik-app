CREATE TYPE public.produk_type AS ENUM (
    'nasi',
    'minuman',
    'kue basah',
    'kue kering'
);
CREATE TYPE public.user_type AS ENUM (
    'penitip',
    'penjual'
);
CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE TABLE public.notifications (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    type character varying(255) NOT NULL,
    title character varying(255) NOT NULL,
    message text NOT NULL,
    data json,
    is_read boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE SEQUENCE public.notifications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE TABLE public.produks (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE SEQUENCE public.produks_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE TABLE public.tbl_pengajuan (
    pengajuan_id integer NOT NULL,
    penitip_id integer NOT NULL,
    penjual_id integer NOT NULL,
    created_at timestamp without time zone NOT NULL,
    created_by character varying NOT NULL,
    updated_at timestamp without time zone,
    update_by character varying,
    status character varying(20) DEFAULT 'pending'::character varying NOT NULL,
    reject_reason character varying
);
CREATE TABLE public.tbl_pengajuan_detail (
    pengajuan_detail_id integer NOT NULL,
    produk_id integer NOT NULL,
    pengajuan_id integer NOT NULL,
    harga_modal character varying NOT NULL,
    harga_jual character varying NOT NULL,
    created_at timestamp without time zone NOT NULL,
    created_by character varying NOT NULL,
    updated_at timestamp without time zone,
    update_by character varying,
    status character varying(255) DEFAULT 'Pending'::character varying NOT NULL
);
CREATE SEQUENCE public.tbl_pengajuan_detail_pengajuan_detail_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE SEQUENCE public.tbl_pengajuan_pengajuan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE TABLE public.tbl_penitip (
    penitip_id integer NOT NULL,
    user_id integer NOT NULL,
    no_hp character varying NOT NULL,
    alamat character varying NOT NULL,
    name character varying NOT NULL,
    foto_profile character varying NOT NULL,
    is_active boolean DEFAULT false NOT NULL,
    created_at timestamp without time zone NOT NULL,
    update_at timestamp without time zone
);
CREATE SEQUENCE public.tbl_penitip_penitip_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE TABLE public.tbl_penjual (
    penjual_id integer NOT NULL,
    user_id integer NOT NULL,
    no_hp character varying NOT NULL,
    tanggal_join date NOT NULL,
    nama_toko character varying NOT NULL,
    deskripsi_toko character varying NOT NULL,
    jam_tutup timestamp without time zone NOT NULL,
    jam_buka timestamp without time zone NOT NULL,
    nama_pemilik character varying NOT NULL,
    alamat_toko character varying NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone,
    banner character varying(255),
    email character varying(255)
);
CREATE SEQUENCE public.tbl_penjual_penjual_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE TABLE public.tbl_produk (
    produk_id integer NOT NULL,
    produk_name character varying NOT NULL,
    harga_modal character varying NOT NULL,
    harga_jual character varying NOT NULL,
    produk_description character varying NOT NULL,
    is_active boolean DEFAULT false NOT NULL,
    created_at timestamp without time zone NOT NULL,
    produk_type public.produk_type NOT NULL,
    penitip_id integer NOT NULL,
    foto_produk character varying(255),
    updated_at timestamp without time zone
);
CREATE TABLE public.tbl_produk_penjual (
    produk_penjual_id integer NOT NULL,
    produk_id integer NOT NULL,
    penjual_id integer NOT NULL,
    status character varying(20) DEFAULT 'pending'::character varying NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);
CREATE SEQUENCE public.tbl_produk_penjual_produk_penjual_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE SEQUENCE public.tbl_produk_produk_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE TABLE public.tbl_stock_harian (
    stock_id integer NOT NULL,
    stock_qty integer NOT NULL,
    harga_modal character varying NOT NULL,
    harga_jual character varying NOT NULL,
    pendapatan character varying NOT NULL,
    penjual_id integer NOT NULL,
    sisa_stock character varying,
    produk_id integer NOT NULL,
    stock character varying NOT NULL,
    date date NOT NULL,
    created_at timestamp without time zone NOT NULL,
    created_by character varying NOT NULL,
    update_at timestamp without time zone,
    uodate_by character varying,
    validasi_foto character varying,
    sisa_foto character varying
);
CREATE SEQUENCE public.tbl_stock_harian_stock_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE TABLE public.tbl_user (
    user_id integer NOT NULL,
    email character varying NOT NULL,
    password character varying NOT NULL,
    user_type public.user_type NOT NULL
);
CREATE SEQUENCE public.tbl_user_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
CREATE INDEX notifications_user_id_is_read_index ON public.notifications USING btree (user_id, is_read);
CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
