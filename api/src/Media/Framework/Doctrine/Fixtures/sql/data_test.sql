--
-- PostgreSQL database dump
--

-- Dumped from database version 15.4
-- Dumped by pg_dump version 17.0 (Ubuntu 17.0-1.pgdg22.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: auth_users; Type: TABLE DATA; Schema: public; Owner: api-platform
--



--
-- Data for Name: events_store; Type: TABLE DATA; Schema: public; Owner: api-platform
--



--
-- Data for Name: media_directors; Type: TABLE DATA; Schema: public; Owner: api-platform
--

INSERT INTO public.media_directors VALUES ('01929558-e34b-1d6a-8e40-b3edcb46b058', 'Alfred', 'Hitchcock');
INSERT INTO public.media_directors VALUES ('01929558-e366-89f1-4cec-427f65d012f4', 'Stanley', 'Kubrick');
INSERT INTO public.media_directors VALUES ('01929558-e368-3c3f-c08d-3953e4683751', 'Akira', 'Kurosawa');
INSERT INTO public.media_directors VALUES ('01929558-e36a-a72f-7858-4a2839cd62b7', 'Quentin', 'Tarantino');
INSERT INTO public.media_directors VALUES ('01929558-e36c-5de7-9bfa-d77e0a0f764a', 'David', 'Lynch');
INSERT INTO public.media_directors VALUES ('01929558-e36e-0b12-a50e-50b1a7f06437', 'Federico', 'Fellini');
INSERT INTO public.media_directors VALUES ('01929558-e36f-6e4f-be53-fb6b4acad38c', 'Ingmar', 'Bergman');
INSERT INTO public.media_directors VALUES ('01929558-e371-cca4-202b-f9ddd12a4d58', 'Charlie', 'Chaplin');
INSERT INTO public.media_directors VALUES ('01929558-e373-2fe9-f294-94318d3fd764', 'Steven', 'Spielberg');
INSERT INTO public.media_directors VALUES ('01929558-e374-2235-622e-f1e219d60dce', 'Christopher', 'Nolan');
INSERT INTO public.media_directors VALUES ('01929558-e376-5311-5f1e-00a85beb43f0', 'Kathryn', 'Bigelow');
INSERT INTO public.media_directors VALUES ('01929558-e378-cfb3-d2d2-06a4baa49720', 'Sofia', 'Coppola');
INSERT INTO public.media_directors VALUES ('01929558-e37a-3259-950f-1508265da478', 'Hayao', 'Miyazaki');
INSERT INTO public.media_directors VALUES ('01929558-e37c-d3f9-5218-675f178549ce', 'Wong', 'Kar-wai');
INSERT INTO public.media_directors VALUES ('01929558-e37e-2de5-2a03-6c38b2abe0c9', 'Aki', 'Kaurismäki');
INSERT INTO public.media_directors VALUES ('01929558-e37f-ba4d-9000-a1546a9ad8e1', 'Chantal', 'Akerman');
INSERT INTO public.media_directors VALUES ('01929558-e381-e133-65c7-4ccb3f78faa5', 'Agnes', 'Varda');
INSERT INTO public.media_directors VALUES ('01929558-e383-be41-2e34-c359ebb670f5', 'Spike', 'Lee');
INSERT INTO public.media_directors VALUES ('01929558-e385-109f-1649-6cd4b0e6ef10', 'Pedro', 'Almodóvar');
INSERT INTO public.media_directors VALUES ('01929558-e386-1729-c3a1-5b84388e584c', 'Céline', 'Sciamma');
INSERT INTO public.media_directors VALUES ('01929558-e388-3781-6def-e7920d1fc1d9', 'Claire', 'Denis');
INSERT INTO public.media_directors VALUES ('01929558-e38a-c01a-5e1c-69354754d746', 'Alice', 'Rohrwacher');
INSERT INTO public.media_directors VALUES ('01929558-e38c-2521-1f15-af2c828d0446', 'Mira', 'Nair');
INSERT INTO public.media_directors VALUES ('01929558-e38d-78ae-f354-1321e923593b', 'Julie', 'Dash');
INSERT INTO public.media_directors VALUES ('01929558-e38f-a078-0e86-ab52b44a53ab', 'Deepa', 'Mehta');
INSERT INTO public.media_directors VALUES ('01929558-e391-18b6-7f63-8a1f1bbb2333', 'Lucrecia', 'Martel');


--
-- Data for Name: media_genres; Type: TABLE DATA; Schema: public; Owner: api-platform
--

INSERT INTO public.media_genres VALUES ('01929558-e394-4895-2661-63b0ce7f3569', 'drama');
INSERT INTO public.media_genres VALUES ('01929558-e397-2486-df68-50a2cdbb26dd', 'comedia');
INSERT INTO public.media_genres VALUES ('01929558-e398-5e8a-8354-3457a9565e34', 'acción');
INSERT INTO public.media_genres VALUES ('01929558-e399-a6e4-1f6b-32f9b21521c9', 'aventura');
INSERT INTO public.media_genres VALUES ('01929558-e39b-ae4c-6345-0623a72f0cbb', 'ciencia ficción');
INSERT INTO public.media_genres VALUES ('01929558-e39c-d8ac-1694-9e38d8282de3', 'fantasía');
INSERT INTO public.media_genres VALUES ('01929558-e39e-623d-3e60-745b4c5e20fc', 'terror');
INSERT INTO public.media_genres VALUES ('01929558-e39f-e8e8-6f0d-0fae2b468425', 'thriller');
INSERT INTO public.media_genres VALUES ('01929558-e3a1-a9f0-c7dd-23a2f01a2c5b', 'romance');
INSERT INTO public.media_genres VALUES ('01929558-e3a2-7fd8-e26f-faca78fc06ab', 'histórico');
INSERT INTO public.media_genres VALUES ('01929558-e3a4-654d-1916-176358a8a0ee', 'bélico');
INSERT INTO public.media_genres VALUES ('01929558-e3a5-604f-d7b4-bbb1ba49a52a', 'western');
INSERT INTO public.media_genres VALUES ('01929558-e3a6-91c8-3fc7-86f9e983d4fa', 'policial');
INSERT INTO public.media_genres VALUES ('01929558-e3a8-d7d3-a467-eac5746449fc', 'musical');
INSERT INTO public.media_genres VALUES ('01929558-e3a9-7961-31c8-1f4ce06b3c43', 'animación');
INSERT INTO public.media_genres VALUES ('01929558-e3aa-1a0d-72b2-a1063bd1b7ee', 'documental');
INSERT INTO public.media_genres VALUES ('01929558-e3ac-0dcd-8f28-3835ca102c13', 'deportivo');
INSERT INTO public.media_genres VALUES ('01929558-e3ad-2fb8-0727-4954b5ab137a', 'neo-noir');
INSERT INTO public.media_genres VALUES ('01929558-e3af-c8a6-34e6-9eb2cc75cb6a', 'cyberpunk');
INSERT INTO public.media_genres VALUES ('01929558-e3b0-3803-b550-1bfc1a9913a3', 'distopía');
INSERT INTO public.media_genres VALUES ('01929558-e3b2-dd1c-87fe-185593d6b50b', 'road movie');
INSERT INTO public.media_genres VALUES ('01929558-e3b3-dd23-a0a1-eefc42dee805', 'coming-of-age');
INSERT INTO public.media_genres VALUES ('01929558-e3b5-938d-a973-626dc162c325', 'superhéroe');
INSERT INTO public.media_genres VALUES ('01929558-e3b6-b42d-f095-19487bd0153a', 'biográfico');
INSERT INTO public.media_genres VALUES ('01929558-e3b8-b1a7-121d-ea8b822d1613', 'psicológico');
INSERT INTO public.media_genres VALUES ('01929558-e3b9-bc3e-ae69-043137b6f3c2', 'de época');


--
-- Data for Name: media_movies; Type: TABLE DATA; Schema: public; Owner: api-platform
--

INSERT INTO public.media_movies VALUES ('01929558-e3cc-4f41-114a-f0f24725e6f9', '01929558-e37f-ba4d-9000-a1546a9ad8e1', 'La Nube Purpura', 1987, 'Un joven artista se muda a una isla remota y descubre un mundo mágico lleno de criaturas extrañas.', 'General Audiences', 7, 7);
INSERT INTO public.media_movies VALUES ('01929558-e3d7-ff6e-219c-3032dacf2032', '01929558-e38d-78ae-f354-1321e923593b', 'El Silencio de los Árboles', 2012, 'Un detective investiga una serie de asesinatos en un pequeño pueblo, pero pronto se da cuenta de que hay más de lo que parece.', 'General Audiences', 3, 3);
INSERT INTO public.media_movies VALUES ('01929558-e3de-1747-93f7-c6348b374507', '01929558-e38d-78ae-f354-1321e923593b', 'El Viaje del Tiempo', 2024, 'Un científico descubre una forma de viajar en el tiempo y decide cambiar el pasado, pero las consecuencias son inesperadas.', 'General Audiences', 5, 5);
INSERT INTO public.media_movies VALUES ('01929558-e3e6-2d78-82a4-76e32b310724', '01929558-e38f-a078-0e86-ab52b44a53ab', 'El Jardín de las Estrellas', 1992, 'Un astronauta se enamora de una inteligencia artificial a bordo de una nave espacial.', 'General Audiences', 4, 4);
INSERT INTO public.media_movies VALUES ('01929558-e3ec-b75a-e145-21dc5aa290f9', '01929558-e38f-a078-0e86-ab52b44a53ab', 'La Sombra del Gigante', 2005, 'Un escritor de terror se muda a una casa antigua y empieza a experimentar sucesos paranormales.', 'General Audiences', 6, 6);
INSERT INTO public.media_movies VALUES ('01929558-e3f2-f104-0fb6-7c617301e137', '01929558-e38f-a078-0e86-ab52b44a53ab', 'El Último Guerrero', 1978, 'Un maestro de artes marciales debe proteger a un pueblo de un ejército invasor.', 'General Audiences', 9, 9);
INSERT INTO public.media_movies VALUES ('01929558-e3f9-da55-88f8-83c69238fb40', '01929558-e383-be41-2e34-c359ebb670f5', 'La Ciudad Perdida', 2014, 'Un grupo de exploradores descubre una ciudad perdida en la selva amazónica.', 'General Audiences', 2, 2);
INSERT INTO public.media_movies VALUES ('01929558-e3fe-c4bc-7dd4-b0ff6580dc4c', '01929558-e378-cfb3-d2d2-06a4baa49720', 'La Sombra del Leviatán', 1972, 'En un futuro distópico, un hombre descubre una conspiración que amenaza la libertad individual.', 'General Audiences', 6, 6);
INSERT INTO public.media_movies VALUES ('01929558-e404-aff3-0b43-e35011b70085', '01929558-e388-3781-6def-e7920d1fc1d9', 'El Jardín de Cristal Negro', 2001, 'Una joven descubre que tiene poderes mágicos y debe enfrentarse a una antigua profecía.', 'General Audiences', 4, 4);
INSERT INTO public.media_movies VALUES ('01929558-e409-c8eb-b590-5768855ff671', '01929558-e38f-a078-0e86-ab52b44a53ab', 'La Ciudad de las Nubes', 1938, 'Un inventor crea una máquina que permite a las personas viajar a las nubes y construir una nueva sociedad.', 'General Audiences', 5, 5);


--
-- Data for Name: media_reviews; Type: TABLE DATA; Schema: public; Owner: api-platform
--

INSERT INTO public.media_reviews VALUES ('01929558-e3cc-4f41-114a-f0f24725e6fa', '01929558-e3cc-4f41-114a-f0f24725e6f9', 'Una obra maestra visual que explora la soledad y la conexión humana.', 9);
INSERT INTO public.media_reviews VALUES ('01929558-e3cc-4f41-114a-f0f24725e6fb', '01929558-e3cc-4f41-114a-f0f24725e6f9', 'Una película conmovedora y poética que te dejará pensando.', 8);
INSERT INTO public.media_reviews VALUES ('01929558-e3d8-d766-c03d-9f70751729c9', '01929558-e3d7-ff6e-219c-3032dacf2032', 'Un thriller psicológico intenso y lleno de giros inesperados.', 10);
INSERT INTO public.media_reviews VALUES ('01929558-e3d8-d766-c03d-9f70751729ca', '01929558-e3d7-ff6e-219c-3032dacf2032', 'Una película que te mantendrá al borde del asiento hasta el final.', 9);
INSERT INTO public.media_reviews VALUES ('01929558-e3d8-d766-c03d-9f70751729cb', '01929558-e3d7-ff6e-219c-3032dacf2032', 'Una trama compleja y bien desarrollada que te hará cuestionar todo.', 8);
INSERT INTO public.media_reviews VALUES ('01929558-e3df-e780-1166-f1f0a611cd8a', '01929558-e3de-1747-93f7-c6348b374507', 'Una aventura épica que desafía las leyes de la física y el tiempo.', 7);
INSERT INTO public.media_reviews VALUES ('01929558-e3df-e780-1166-f1f0a611cd8b', '01929558-e3de-1747-93f7-c6348b374507', 'Una película visualmente impresionante con efectos especiales de última generación.', 8);
INSERT INTO public.media_reviews VALUES ('01929558-e3e6-2d78-82a4-76e32b310725', '01929558-e3e6-2d78-82a4-76e32b310724', 'Una historia de amor cósmica que te dejará sin aliento.', 7);
INSERT INTO public.media_reviews VALUES ('01929558-e3e6-2d78-82a4-76e32b310726', '01929558-e3e6-2d78-82a4-76e32b310724', 'Una película visualmente impresionante con efectos especiales innovadores para su época.', 8);
INSERT INTO public.media_reviews VALUES ('01929558-e3ec-b75a-e145-21dc5aa290fa', '01929558-e3ec-b75a-e145-21dc5aa290f9', 'Un thriller psicológico intenso y claustrofóbico.', 9);
INSERT INTO public.media_reviews VALUES ('01929558-e3ec-b75a-e145-21dc5aa290fb', '01929558-e3ec-b75a-e145-21dc5aa290f9', 'Una película que te mantendrá en vilo hasta el último minuto.', 8);
INSERT INTO public.media_reviews VALUES ('01929558-e3f2-f104-0fb6-7c617301e138', '01929558-e3f2-f104-0fb6-7c617301e137', 'Una película de acción épica con impresionantes escenas de lucha.', 7);
INSERT INTO public.media_reviews VALUES ('01929558-e3f2-f104-0fb6-7c617301e139', '01929558-e3f2-f104-0fb6-7c617301e137', 'Un homenaje a las películas de artes marciales clásicas.', 8);
INSERT INTO public.media_reviews VALUES ('01929558-e3f9-da55-88f8-83c69238fb41', '01929558-e3f9-da55-88f8-83c69238fb40', 'Una aventura emocionante llena de misterios y peligros.', 6);
INSERT INTO public.media_reviews VALUES ('01929558-e3f9-da55-88f8-83c69238fb42', '01929558-e3f9-da55-88f8-83c69238fb40', 'Una película ideal para pasar un rato entretenido.', 7);
INSERT INTO public.media_reviews VALUES ('01929558-e3fe-c4bc-7dd4-b0ff6580dc4d', '01929558-e3fe-c4bc-7dd4-b0ff6580dc4c', 'Una alegoría política perturbadora que te hará cuestionar el poder.', 9);
INSERT INTO public.media_reviews VALUES ('01929558-e3fe-c4bc-7dd4-b0ff6580dc4e', '01929558-e3fe-c4bc-7dd4-b0ff6580dc4c', 'Una película con una atmósfera opresiva y una banda sonora inolvidable.', 8);
INSERT INTO public.media_reviews VALUES ('01929558-e404-aff3-0b43-e35011b70086', '01929558-e404-aff3-0b43-e35011b70085', 'Una historia de amor sobrenatural ambientada en un mundo mágico.', 7);
INSERT INTO public.media_reviews VALUES ('01929558-e404-aff3-0b43-e35011b70087', '01929558-e404-aff3-0b43-e35011b70085', 'Efectos visuales impresionantes que te transportarán a otro mundo.', 8);
INSERT INTO public.media_reviews VALUES ('01929558-e409-c8eb-b590-5768855ff672', '01929558-e409-c8eb-b590-5768855ff671', 'Una película de ciencia ficción pionera que explora los límites de la imaginación.', 8);
INSERT INTO public.media_reviews VALUES ('01929558-e409-c8eb-b590-5768855ff673', '01929558-e409-c8eb-b590-5768855ff671', 'Una historia conmovedora sobre la soledad y la búsqueda de la identidad.', 7);


--
-- Data for Name: movie_genre; Type: TABLE DATA; Schema: public; Owner: api-platform
--

INSERT INTO public.movie_genre VALUES ('01929558-e3cc-4f41-114a-f0f24725e6f9', '01929558-e398-5e8a-8354-3457a9565e34');
INSERT INTO public.movie_genre VALUES ('01929558-e3cc-4f41-114a-f0f24725e6f9', '01929558-e3a6-91c8-3fc7-86f9e983d4fa');
INSERT INTO public.movie_genre VALUES ('01929558-e3d7-ff6e-219c-3032dacf2032', '01929558-e3b3-dd23-a0a1-eefc42dee805');
INSERT INTO public.movie_genre VALUES ('01929558-e3de-1747-93f7-c6348b374507', '01929558-e3aa-1a0d-72b2-a1063bd1b7ee');
INSERT INTO public.movie_genre VALUES ('01929558-e3de-1747-93f7-c6348b374507', '01929558-e39e-623d-3e60-745b4c5e20fc');
INSERT INTO public.movie_genre VALUES ('01929558-e3de-1747-93f7-c6348b374507', '01929558-e3a4-654d-1916-176358a8a0ee');
INSERT INTO public.movie_genre VALUES ('01929558-e3de-1747-93f7-c6348b374507', '01929558-e3b9-bc3e-ae69-043137b6f3c2');
INSERT INTO public.movie_genre VALUES ('01929558-e3e6-2d78-82a4-76e32b310724', '01929558-e398-5e8a-8354-3457a9565e34');
INSERT INTO public.movie_genre VALUES ('01929558-e3e6-2d78-82a4-76e32b310724', '01929558-e3a8-d7d3-a467-eac5746449fc');
INSERT INTO public.movie_genre VALUES ('01929558-e3ec-b75a-e145-21dc5aa290f9', '01929558-e3b6-b42d-f095-19487bd0153a');
INSERT INTO public.movie_genre VALUES ('01929558-e3ec-b75a-e145-21dc5aa290f9', '01929558-e3a5-604f-d7b4-bbb1ba49a52a');
INSERT INTO public.movie_genre VALUES ('01929558-e3f2-f104-0fb6-7c617301e137', '01929558-e3b5-938d-a973-626dc162c325');
INSERT INTO public.movie_genre VALUES ('01929558-e3f2-f104-0fb6-7c617301e137', '01929558-e3aa-1a0d-72b2-a1063bd1b7ee');
INSERT INTO public.movie_genre VALUES ('01929558-e3f2-f104-0fb6-7c617301e137', '01929558-e3b8-b1a7-121d-ea8b822d1613');
INSERT INTO public.movie_genre VALUES ('01929558-e3f9-da55-88f8-83c69238fb40', '01929558-e3b9-bc3e-ae69-043137b6f3c2');
INSERT INTO public.movie_genre VALUES ('01929558-e3f9-da55-88f8-83c69238fb40', '01929558-e397-2486-df68-50a2cdbb26dd');
INSERT INTO public.movie_genre VALUES ('01929558-e3fe-c4bc-7dd4-b0ff6580dc4c', '01929558-e3a8-d7d3-a467-eac5746449fc');
INSERT INTO public.movie_genre VALUES ('01929558-e3fe-c4bc-7dd4-b0ff6580dc4c', '01929558-e3a5-604f-d7b4-bbb1ba49a52a');
INSERT INTO public.movie_genre VALUES ('01929558-e404-aff3-0b43-e35011b70085', '01929558-e3b9-bc3e-ae69-043137b6f3c2');
INSERT INTO public.movie_genre VALUES ('01929558-e409-c8eb-b590-5768855ff671', '01929558-e3ad-2fb8-0727-4954b5ab137a');


--
-- Data for Name: refresh_tokens; Type: TABLE DATA; Schema: public; Owner: api-platform
--



--
-- Name: refresh_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: api-platform
--

SELECT pg_catalog.setval('public.refresh_tokens_id_seq', 1, false);


--
-- PostgreSQL database dump complete
--

