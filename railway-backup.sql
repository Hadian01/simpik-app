--
-- PostgreSQL database dump
--

\restrict 0svtWzFLKvjErhxFEZFcNrrM0BpoEwvViineGpVVUE3E98yoBbBdEYN2YgfERaZ

-- Dumped from database version 18.2
-- Dumped by pg_dump version 18.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: produk_type; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.produk_type AS ENUM (
    'nasi',
    'minuman',
    'kue basah',
    'kue kering'
);


--
-- Name: user_type; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.user_type AS ENUM (
    'penitip',
    'penjual'
);


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: notifications; Type: TABLE; Schema: public; Owner: -
--

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


--
-- Name: notifications_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.notifications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: notifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.notifications_id_seq OWNED BY public.notifications.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: -
--

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


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: produks; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.produks (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: produks_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.produks_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: produks_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.produks_id_seq OWNED BY public.produks.id;


--
-- Name: tbl_pengajuan; Type: TABLE; Schema: public; Owner: -
--

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


--
-- Name: tbl_pengajuan_detail; Type: TABLE; Schema: public; Owner: -
--

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


--
-- Name: tbl_pengajuan_detail_pengajuan_detail_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tbl_pengajuan_detail_pengajuan_detail_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tbl_pengajuan_detail_pengajuan_detail_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tbl_pengajuan_detail_pengajuan_detail_id_seq OWNED BY public.tbl_pengajuan_detail.pengajuan_detail_id;


--
-- Name: tbl_pengajuan_pengajuan_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tbl_pengajuan_pengajuan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tbl_pengajuan_pengajuan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tbl_pengajuan_pengajuan_id_seq OWNED BY public.tbl_pengajuan.pengajuan_id;


--
-- Name: tbl_penitip; Type: TABLE; Schema: public; Owner: -
--

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


--
-- Name: tbl_penitip_penitip_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tbl_penitip_penitip_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tbl_penitip_penitip_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tbl_penitip_penitip_id_seq OWNED BY public.tbl_penitip.penitip_id;


--
-- Name: tbl_penjual; Type: TABLE; Schema: public; Owner: -
--

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


--
-- Name: tbl_penjual_penjual_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tbl_penjual_penjual_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tbl_penjual_penjual_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tbl_penjual_penjual_id_seq OWNED BY public.tbl_penjual.penjual_id;


--
-- Name: tbl_produk; Type: TABLE; Schema: public; Owner: -
--

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


--
-- Name: tbl_produk_penjual; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbl_produk_penjual (
    produk_penjual_id integer NOT NULL,
    produk_id integer NOT NULL,
    penjual_id integer NOT NULL,
    status character varying(20) DEFAULT 'pending'::character varying NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


--
-- Name: tbl_produk_penjual_produk_penjual_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tbl_produk_penjual_produk_penjual_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tbl_produk_penjual_produk_penjual_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tbl_produk_penjual_produk_penjual_id_seq OWNED BY public.tbl_produk_penjual.produk_penjual_id;


--
-- Name: tbl_produk_produk_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tbl_produk_produk_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tbl_produk_produk_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tbl_produk_produk_id_seq OWNED BY public.tbl_produk.produk_id;


--
-- Name: tbl_stock_harian; Type: TABLE; Schema: public; Owner: -
--

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


--
-- Name: tbl_stock_harian_stock_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tbl_stock_harian_stock_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tbl_stock_harian_stock_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tbl_stock_harian_stock_id_seq OWNED BY public.tbl_stock_harian.stock_id;


--
-- Name: tbl_user; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbl_user (
    user_id integer NOT NULL,
    email character varying NOT NULL,
    password character varying NOT NULL,
    user_type public.user_type NOT NULL
);


--
-- Name: tbl_user_user_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tbl_user_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tbl_user_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tbl_user_user_id_seq OWNED BY public.tbl_user.user_id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: -
--

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


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: notifications id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notifications ALTER COLUMN id SET DEFAULT nextval('public.notifications_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: produks id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produks ALTER COLUMN id SET DEFAULT nextval('public.produks_id_seq'::regclass);


--
-- Name: tbl_pengajuan pengajuan_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_pengajuan ALTER COLUMN pengajuan_id SET DEFAULT nextval('public.tbl_pengajuan_pengajuan_id_seq'::regclass);


--
-- Name: tbl_pengajuan_detail pengajuan_detail_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_pengajuan_detail ALTER COLUMN pengajuan_detail_id SET DEFAULT nextval('public.tbl_pengajuan_detail_pengajuan_detail_id_seq'::regclass);


--
-- Name: tbl_penitip penitip_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_penitip ALTER COLUMN penitip_id SET DEFAULT nextval('public.tbl_penitip_penitip_id_seq'::regclass);


--
-- Name: tbl_penjual penjual_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_penjual ALTER COLUMN penjual_id SET DEFAULT nextval('public.tbl_penjual_penjual_id_seq'::regclass);


--
-- Name: tbl_produk produk_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_produk ALTER COLUMN produk_id SET DEFAULT nextval('public.tbl_produk_produk_id_seq'::regclass);


--
-- Name: tbl_produk_penjual produk_penjual_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_produk_penjual ALTER COLUMN produk_penjual_id SET DEFAULT nextval('public.tbl_produk_penjual_produk_penjual_id_seq'::regclass);


--
-- Name: tbl_stock_harian stock_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_stock_harian ALTER COLUMN stock_id SET DEFAULT nextval('public.tbl_stock_harian_stock_id_seq'::regclass);


--
-- Name: tbl_user user_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_user ALTER COLUMN user_id SET DEFAULT nextval('public.tbl_user_user_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_reset_tokens_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
5	2026_02_17_124429_create_produks_table	2
6	2026_03_02_150424_add_status_to_tbl_pengajuan_detail	2
7	2026_03_06_151257_fix_tbl_produk_columns	3
8	2026_04_05_155517_add_banner_to_tbl_penjual_table	4
9	2026_04_05_164414_create_notifications_table	5
\.


--
-- Data for Name: notifications; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.notifications (id, user_id, type, title, message, data, is_read, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: produks; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.produks (id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: tbl_pengajuan; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.tbl_pengajuan (pengajuan_id, penitip_id, penjual_id, created_at, created_by, updated_at, update_by, status, reject_reason) FROM stdin;
1	1	1	2025-02-19 00:00:00	Hadian	2026-03-15 17:06:04	Hadian	Approved	\N
2	1	2	2025-02-19 00:00:00	Hadian	2026-03-15 17:06:04	Hadian	Approved	\N
5	1	3	2026-03-06 18:22:07	1	2026-03-15 17:06:04	Hadian	Rejected	tes
6	1	6	2026-03-15 10:00:00	hadian	\N	\N	Approved	\N
7	2	6	2026-03-20 14:30:00	Dian	\N	\N	Approved	\N
8	3	6	2026-04-01 09:15:00	Desi	\N	\N	Pending	\N
\.


--
-- Data for Name: tbl_pengajuan_detail; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.tbl_pengajuan_detail (pengajuan_detail_id, produk_id, pengajuan_id, harga_modal, harga_jual, created_at, created_by, updated_at, update_by, status) FROM stdin;
1	1	2	8000	10000	2026-02-19 00:00:00	Hadian	\N	\N	Approved
4	1	5	8000	10000	2026-03-06 18:22:07	1	\N	\N	Rejected
2	2	1	7000	10000	2026-02-19 00:00:00	dian	2026-03-15 17:06:04	\N	Approved
6	1	6	3000	5000	2026-04-05 23:07:00.304051	hadian	\N	\N	Approved
7	2	6	4000	6000	2026-04-05 23:07:00.304051	hadian	\N	\N	Approved
8	5	6	5000	8000	2026-04-05 23:07:00.304051	hadian	\N	\N	Approved
9	6	6	2000	4000	2026-04-05 23:07:00.304051	hadian	\N	\N	Pending
10	1	7	3000	5000	2026-04-05 23:07:00.304051	Dian	\N	\N	Approved
11	2	7	4000	6000	2026-04-05 23:07:00.304051	Dian	\N	\N	Approved
\.


--
-- Data for Name: tbl_penitip; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.tbl_penitip (penitip_id, user_id, no_hp, alamat, name, foto_profile, is_active, created_at, update_at) FROM stdin;
2	2	-	-	Dian	default.jpg	t	2026-04-05 22:19:58.902173	\N
3	3	-	-	Desi	default.jpg	t	2026-04-05 22:19:58.902173	\N
4	4	-	-	Riki	default.jpg	t	2026-04-05 22:19:58.902173	\N
5	5	-	-	Belia	default.jpg	t	2026-04-05 22:19:58.902173	\N
1	7	081245638	marinajaya	hadian	profiles/profile_1_1775406343.jpg	t	2026-02-01 00:00:00	\N
\.


--
-- Data for Name: tbl_penjual; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.tbl_penjual (penjual_id, user_id, no_hp, tanggal_join, nama_toko, deskripsi_toko, jam_tutup, jam_buka, nama_pemilik, alamat_toko, created_at, updated_at, banner, email) FROM stdin;
1	2	081234567890	2026-02-18	Toko Kue Dian	Menjual berbagai macam kue basah dan kue kering.	2026-02-18 17:00:00	2026-02-18 07:00:00	Dian Pratama	Bengkong, Batam	2026-02-18 21:38:04.089594	2026-02-18 21:38:04.089594	\N	\N
2	3	082345678901	2026-02-18	Bakery Manis Jaya	Spesialis roti dan pastry premium.	2026-02-18 18:00:00	2026-02-18 08:00:00	Sari Indah	Batam Center, Batam	2026-02-18 21:38:04.089594	2026-02-18 21:38:04.089594	\N	\N
3	4	081234560987	2026-02-18	Toko Kue Riki	Menjual berbagai macam kue basah dan kue kering.	2026-02-18 17:00:00	2026-02-18 07:00:00	Dian Pratama	Bengkong, Batam	2026-02-18 21:42:30.213639	2026-02-18 21:42:30.213639	\N	\N
4	5	082345670374	2026-02-18	Bakery Manis Jaya Belia	Spesialis roti dan pastry premium.	2026-02-18 18:00:00	2026-02-18 08:00:00	Sari Indah	Batam Center, Batam	2026-02-18 21:42:30.213639	2026-02-18 21:42:30.213639	\N	\N
5	6	-	2026-04-05	Toko6	-	2026-04-05 23:59:59	2026-04-05 00:00:00	-	-	2026-04-05 15:09:47	\N	\N	\N
6	1	081234567890	2026-02-18	Toko Hadianz	Toko Kue Berkualitas	2026-04-05 18:00:00	2026-04-05 08:00:00	Hadian Nelvi	Batam	2026-04-05 22:23:45.583642	2026-04-05 15:59:34	\N	hadian@gmail.com
\.


--
-- Data for Name: tbl_produk; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.tbl_produk (produk_id, produk_name, harga_modal, harga_jual, produk_description, is_active, created_at, produk_type, penitip_id, foto_produk, updated_at) FROM stdin;
1	nasi kuning	8000	10000	nasi kuning	t	2026-03-06 14:30:00	nasi	1	\N	\N
2	nasi lemak	7000	10000	Nasi Lemak	t	2026-03-06 14:30:00	nasi	1	\N	\N
5	Lapis	2000	4000	Lapis	t	2026-03-06 16:32:26	kue basah	1	produk_foto/asdCi53DVIdGkssCPmzpLiq068uUcJKYvlneuRco.png	2026-03-06 17:03:55
6	es gula batu	2000	5000	es gula batu	t	2026-03-19 14:52:54	minuman	1	produk_foto/8Ezi3hnPHL4NmB2wOm59yXpav1KFERsGO8v8JSpt.jpg	2026-03-19 14:52:54
\.


--
-- Data for Name: tbl_produk_penjual; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.tbl_produk_penjual (produk_penjual_id, produk_id, penjual_id, status, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: tbl_stock_harian; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.tbl_stock_harian (stock_id, stock_qty, harga_modal, harga_jual, pendapatan, penjual_id, sisa_stock, produk_id, stock, date, created_at, created_by, update_at, uodate_by, validasi_foto, sisa_foto) FROM stdin;
2	15	8000	10000	96000	2	3	1	15	2026-03-15	2026-03-15 00:00:00	Hadian	\N	\N	\N	\N
3	18	8000	10000	120000	2	3	1	18	2026-03-14	2026-03-14 00:00:00	Hadian	\N	\N	\N	\N
5	12	2000	4000	0	2	\N	5	12	2026-03-15	2026-03-15 16:12:47	penitip	\N	\N	\N	\N
6	34	7000	10000	0	2	\N	2	34	2026-03-15	2026-03-15 16:14:44	penitip	\N	\N	\N	\N
7	15	2000	4000	0	2	\N	5	15	2026-03-15	2026-03-15 16:14:53	penitip	\N	\N	\N	\N
8	45	8000	10000	0	2	\N	1	45	2026-03-15	2026-03-15 16:15:02	penitip	\N	\N	\N	\N
9	12	2000	4000	0	2	\N	5	12	2026-03-15	2026-03-15 16:15:15	penitip	\N	\N	\N	\N
10	22	7000	10000	0	2	\N	2	22	2026-03-15	2026-03-15 16:15:23	penitip	\N	\N	\N	\N
11	122	7000	10000	0	2	\N	2	122	2026-03-15	2026-03-15 16:15:30	penitip	\N	\N	\N	\N
12	122	7000	10000	0	2	\N	2	122	2026-03-15	2026-03-15 16:15:31	penitip	\N	\N	\N	\N
13	11	2000	4000	0	2	\N	5	11	2026-03-15	2026-03-15 16:15:57	penitip	\N	\N	\N	\N
14	11	2000	4000	0	2	\N	5	11	2026-03-15	2026-03-15 16:15:57	penitip	\N	\N	\N	\N
15	15	8000	10000	0	1	\N	1	15	2026-03-19	2026-03-19 14:54:46	penitip	\N	\N	\N	\N
16	50	3000	5000	20000	6	30	1	50	2026-04-01	2026-04-05 23:07:18.524704	hadian	\N	\N	\N	\N
17	40	4000	6000	16000	6	24	2	40	2026-04-01	2026-04-05 23:07:18.524704	hadian	\N	\N	\N	\N
18	30	5000	8000	30000	6	20	5	30	2026-04-01	2026-04-05 23:07:18.524704	hadian	\N	\N	\N	\N
19	50	3000	5000	25000	6	25	1	50	2026-04-02	2026-04-05 23:07:18.524704	hadian	\N	\N	\N	\N
20	45	4000	6000	24000	6	21	2	45	2026-04-02	2026-04-05 23:07:18.524704	hadian	\N	\N	\N	\N
21	35	5000	8000	35000	6	20	5	35	2026-04-02	2026-04-05 23:07:18.524704	hadian	\N	\N	\N	\N
22	60	3000	5000	40000	6	20	1	60	2026-04-03	2026-04-05 23:07:18.524704	Dian	\N	\N	\N	\N
23	50	4000	6000	30000	6	20	2	50	2026-04-03	2026-04-05 23:07:18.524704	Dian	\N	\N	\N	\N
24	55	3000	5000	35000	6	20	1	55	2026-04-04	2026-04-05 23:07:18.524704	hadian	\N	\N	\N	\N
25	48	4000	6000	28000	6	20	2	48	2026-04-04	2026-04-05 23:07:18.524704	hadian	\N	\N	\N	\N
26	42	5000	8000	44000	6	20	5	42	2026-04-04	2026-04-05 23:07:18.524704	hadian	\N	\N	\N	\N
27	50	3000	5000	30000	6	20	1	50	2026-04-05	2026-04-05 23:07:18.524704	Dian	\N	\N	\N	\N
28	45	4000	6000	25000	6	20	2	45	2026-04-05	2026-04-05 23:07:18.524704	Dian	\N	\N	\N	\N
\.


--
-- Data for Name: tbl_user; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.tbl_user (user_id, email, password, user_type) FROM stdin;
1	hadian@gmail.com	dian	penjual
2	dian@gmail.com	Dian	penitip
3	desi@gmail.com	Desi	penitip
4	riki@gmail.com	Riki	penitip
5	Belia@gmail.com	Belia	penitip
6	penjual@gmail.com	$2y$10$vqtAjBlJX.zKj0bRAfvk2ujFmAVn9CnoQi0/TgUH3apAvXA7AYuNG	penjual
7	penitip.hadian@gmail.com	hadian	penitip
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
\.


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.migrations_id_seq', 9, true);


--
-- Name: notifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.notifications_id_seq', 1, false);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: produks_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.produks_id_seq', 1, false);


--
-- Name: tbl_pengajuan_detail_pengajuan_detail_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tbl_pengajuan_detail_pengajuan_detail_id_seq', 11, true);


--
-- Name: tbl_pengajuan_pengajuan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tbl_pengajuan_pengajuan_id_seq', 8, true);


--
-- Name: tbl_penitip_penitip_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tbl_penitip_penitip_id_seq', 5, true);


--
-- Name: tbl_penjual_penjual_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tbl_penjual_penjual_id_seq', 6, true);


--
-- Name: tbl_produk_penjual_produk_penjual_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tbl_produk_penjual_produk_penjual_id_seq', 1, false);


--
-- Name: tbl_produk_produk_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tbl_produk_produk_id_seq', 6, true);


--
-- Name: tbl_stock_harian_stock_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tbl_stock_harian_stock_id_seq', 28, true);


--
-- Name: tbl_user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tbl_user_user_id_seq', 7, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: notifications notifications_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: produks produks_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produks
    ADD CONSTRAINT produks_pkey PRIMARY KEY (id);


--
-- Name: tbl_pengajuan_detail tbl_pengajuan_detail_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_pengajuan_detail
    ADD CONSTRAINT tbl_pengajuan_detail_pkey PRIMARY KEY (pengajuan_detail_id);


--
-- Name: tbl_pengajuan tbl_pengajuan_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_pengajuan
    ADD CONSTRAINT tbl_pengajuan_pkey PRIMARY KEY (pengajuan_id);


--
-- Name: tbl_penitip tbl_penitip_name_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_penitip
    ADD CONSTRAINT tbl_penitip_name_key UNIQUE (name);


--
-- Name: tbl_penitip tbl_penitip_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_penitip
    ADD CONSTRAINT tbl_penitip_pkey PRIMARY KEY (penitip_id);


--
-- Name: tbl_penjual tbl_penjual_nama_toko_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_penjual
    ADD CONSTRAINT tbl_penjual_nama_toko_key UNIQUE (nama_toko);


--
-- Name: tbl_penjual tbl_penjual_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_penjual
    ADD CONSTRAINT tbl_penjual_pkey PRIMARY KEY (penjual_id);


--
-- Name: tbl_produk_penjual tbl_produk_penjual_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_produk_penjual
    ADD CONSTRAINT tbl_produk_penjual_pkey PRIMARY KEY (produk_penjual_id);


--
-- Name: tbl_produk tbl_produk_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_produk
    ADD CONSTRAINT tbl_produk_pkey PRIMARY KEY (produk_id);


--
-- Name: tbl_stock_harian tbl_stock_harian_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_stock_harian
    ADD CONSTRAINT tbl_stock_harian_pkey PRIMARY KEY (stock_id);


--
-- Name: tbl_user tbl_user_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_user
    ADD CONSTRAINT tbl_user_pkey PRIMARY KEY (user_id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: notifications_user_id_is_read_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX notifications_user_id_is_read_index ON public.notifications USING btree (user_id, is_read);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: notifications notifications_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.tbl_user(user_id) ON DELETE CASCADE;


--
-- Name: tbl_pengajuan_detail tbl_pengajuan_detail_pengajuan_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_pengajuan_detail
    ADD CONSTRAINT tbl_pengajuan_detail_pengajuan_id_fkey FOREIGN KEY (pengajuan_id) REFERENCES public.tbl_pengajuan(pengajuan_id) NOT VALID;


--
-- Name: tbl_pengajuan_detail tbl_pengajuan_detail_produk_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_pengajuan_detail
    ADD CONSTRAINT tbl_pengajuan_detail_produk_id_fkey FOREIGN KEY (produk_id) REFERENCES public.tbl_produk(produk_id);


--
-- Name: tbl_pengajuan tbl_pengajuan_penitip_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_pengajuan
    ADD CONSTRAINT tbl_pengajuan_penitip_id_fkey FOREIGN KEY (penitip_id) REFERENCES public.tbl_penitip(penitip_id);


--
-- Name: tbl_pengajuan tbl_pengajuan_penjual_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_pengajuan
    ADD CONSTRAINT tbl_pengajuan_penjual_id_fkey FOREIGN KEY (penjual_id) REFERENCES public.tbl_penjual(penjual_id) NOT VALID;


--
-- Name: tbl_penitip tbl_penitip_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_penitip
    ADD CONSTRAINT tbl_penitip_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.tbl_user(user_id);


--
-- Name: tbl_penjual tbl_penjual_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_penjual
    ADD CONSTRAINT tbl_penjual_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.tbl_user(user_id);


--
-- Name: tbl_produk tbl_produk_penitip_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_produk
    ADD CONSTRAINT tbl_produk_penitip_id_fkey FOREIGN KEY (penitip_id) REFERENCES public.tbl_penitip(penitip_id) NOT VALID;


--
-- Name: tbl_produk_penjual tbl_produk_penjual_penjual_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_produk_penjual
    ADD CONSTRAINT tbl_produk_penjual_penjual_id_fkey FOREIGN KEY (penjual_id) REFERENCES public.tbl_penjual(penjual_id);


--
-- Name: tbl_produk_penjual tbl_produk_penjual_produk_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_produk_penjual
    ADD CONSTRAINT tbl_produk_penjual_produk_id_fkey FOREIGN KEY (produk_id) REFERENCES public.tbl_produk(produk_id);


--
-- Name: tbl_stock_harian tbl_stock_harian_penjual_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_stock_harian
    ADD CONSTRAINT tbl_stock_harian_penjual_id_fkey FOREIGN KEY (penjual_id) REFERENCES public.tbl_penjual(penjual_id);


--
-- Name: tbl_stock_harian tbl_stock_harian_produk_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbl_stock_harian
    ADD CONSTRAINT tbl_stock_harian_produk_id_fkey FOREIGN KEY (produk_id) REFERENCES public.tbl_produk(produk_id) NOT VALID;


--
-- PostgreSQL database dump complete
--

\unrestrict 0svtWzFLKvjErhxFEZFcNrrM0BpoEwvViineGpVVUE3E98yoBbBdEYN2YgfERaZ

