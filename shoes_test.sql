--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: brands; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE brands (
    id integer NOT NULL,
    shoes character varying
);


ALTER TABLE brands OWNER TO "Guest";

--
-- Name: brands_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE brands_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE brands_id_seq OWNER TO "Guest";

--
-- Name: brands_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE brands_id_seq OWNED BY brands.id;


--
-- Name: brands_stores; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE brands_stores (
    id integer NOT NULL,
    shoes_id integer,
    store_id integer,
    sold boolean DEFAULT false
);


ALTER TABLE brands_stores OWNER TO "Guest";

--
-- Name: brands_stores_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE brands_stores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE brands_stores_id_seq OWNER TO "Guest";

--
-- Name: brands_stores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE brands_stores_id_seq OWNED BY brands_stores.id;


--
-- Name: stores; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE stores (
    id integer NOT NULL,
    store character varying
);


ALTER TABLE stores OWNER TO "Guest";

--
-- Name: stores_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE stores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stores_id_seq OWNER TO "Guest";

--
-- Name: stores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE stores_id_seq OWNED BY stores.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY brands ALTER COLUMN id SET DEFAULT nextval('brands_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY brands_stores ALTER COLUMN id SET DEFAULT nextval('brands_stores_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY stores ALTER COLUMN id SET DEFAULT nextval('stores_id_seq'::regclass);


--
-- Data for Name: brands; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY brands (id, shoes) FROM stdin;
\.


--
-- Name: brands_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('brands_id_seq', 1742, true);


--
-- Data for Name: brands_stores; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY brands_stores (id, shoes_id, store_id, sold) FROM stdin;
215	875	892	f
216	875	893	f
217	876	894	f
218	876	895	f
219	876	896	f
220	877	914	f
221	878	914	f
222	879	915	f
223	880	915	f
224	893	916	f
225	893	917	f
226	894	918	f
227	894	919	f
228	894	920	f
229	895	938	f
230	896	938	f
231	897	939	f
232	898	939	f
233	911	940	f
234	911	941	f
235	912	942	f
236	912	943	f
237	913	961	f
238	914	961	f
239	915	962	f
240	916	962	f
241	929	963	f
242	929	964	f
243	930	965	f
244	930	966	f
245	931	984	f
246	932	984	f
247	933	985	f
248	934	985	f
249	947	986	f
250	947	987	f
251	948	988	f
252	948	989	f
253	949	1007	f
254	950	1007	f
255	951	1008	f
256	952	1008	f
257	965	1009	f
258	965	1010	f
259	966	1011	f
260	966	1012	f
261	967	1030	f
262	968	1030	f
263	969	1031	f
264	970	1031	f
265	983	1032	f
266	983	1033	f
267	984	1034	f
268	984	1035	f
269	998	1036	f
270	998	1037	f
271	999	1038	f
272	999	1039	f
273	1001	1057	f
274	1002	1057	f
275	1003	1058	f
276	1004	1058	f
277	1017	1059	f
278	1017	1060	f
279	1018	1061	f
280	1018	1062	f
281	1020	1080	f
282	1021	1080	f
283	1022	1081	f
284	1023	1081	f
285	1036	1082	f
286	1036	1083	f
287	1037	1084	f
288	1037	1085	f
289	1051	1086	f
290	1051	1087	f
291	1052	1088	f
292	1052	1089	f
293	1066	1090	f
294	1066	1091	f
295	1067	1092	f
296	1067	1093	f
297	1081	1094	f
298	1081	1095	f
299	1082	1096	f
300	1082	1097	f
301	1084	1115	f
302	1085	1115	f
303	1086	1116	f
304	1087	1116	f
305	1100	1117	f
306	1100	1118	f
307	1101	1119	f
308	1101	1120	f
309	1103	1138	f
310	1104	1138	f
311	1105	1139	f
312	1106	1139	f
313	1119	1140	f
314	1119	1141	f
315	1120	1142	f
316	1120	1143	f
317	1122	1161	f
318	1123	1161	f
319	1124	1162	f
320	1125	1162	f
321	1138	1163	f
322	1138	1164	f
323	1139	1165	f
324	1139	1166	f
325	1141	1184	f
326	1142	1184	f
327	1143	1185	f
328	1144	1185	f
329	1157	1186	f
330	1157	1187	f
331	1158	1188	f
332	1158	1189	f
333	1160	1207	f
334	1161	1207	f
335	1162	1208	f
336	1163	1208	f
337	1176	1209	f
338	1176	1210	f
339	1177	1211	f
340	1177	1212	f
341	1179	1230	f
342	1180	1230	f
343	1181	1231	f
344	1182	1231	f
345	1195	1232	f
346	1195	1233	f
347	1196	1234	f
348	1196	1235	f
349	1199	1253	f
350	1200	1253	f
351	1201	1254	f
352	1202	1254	f
353	1215	1255	f
354	1215	1256	f
355	1216	1257	f
356	1216	1258	f
357	1219	1276	f
358	1220	1276	f
359	1221	1277	f
360	1222	1277	f
361	1235	1278	f
362	1235	1279	f
363	1236	1280	f
364	1236	1281	f
365	1239	1299	f
366	1240	1299	f
367	1241	1300	f
368	1242	1300	f
369	1255	1301	f
370	1255	1302	f
371	1256	1303	f
372	1256	1304	f
373	1259	1322	f
374	1260	1322	f
375	1261	1323	f
376	1262	1323	f
377	1275	1324	f
378	1275	1325	f
379	1276	1326	f
380	1276	1327	f
381	1279	1345	f
382	1280	1345	f
383	1281	1346	f
384	1282	1346	f
385	1295	1347	f
386	1295	1348	f
387	1296	1349	f
388	1296	1350	f
389	1299	1368	f
390	1300	1368	f
391	1301	1369	f
392	1302	1369	f
393	1315	1370	f
394	1315	1371	f
395	1316	1372	f
396	1316	1373	f
397	1319	1391	f
398	1320	1391	f
399	1321	1392	f
400	1322	1392	f
401	1335	1393	f
402	1335	1394	f
403	1336	1395	f
404	1336	1396	f
405	1339	1414	f
406	1340	1414	f
407	1341	1415	f
408	1342	1415	f
409	1355	1416	f
410	1355	1417	f
411	1356	1418	f
412	1356	1419	f
413	1359	1437	f
414	1360	1437	f
415	1361	1438	f
416	1362	1438	f
417	1375	1439	f
418	1375	1440	f
419	1376	1441	f
420	1376	1442	f
421	1379	1460	f
422	1380	1460	f
423	1381	1461	f
424	1382	1461	f
425	1395	1462	f
426	1395	1463	f
427	1396	1464	f
428	1396	1465	f
429	1399	1483	f
430	1400	1483	f
431	1401	1484	f
432	1402	1484	f
433	1415	1485	f
434	1415	1486	f
435	1416	1487	f
436	1416	1488	f
437	1419	1506	f
438	1420	1506	f
439	1421	1507	f
440	1422	1507	f
441	1435	1508	f
442	1435	1509	f
443	1436	1510	f
444	1436	1511	f
445	1439	1529	f
446	1440	1529	f
447	1441	1530	f
448	1442	1530	f
449	1455	1531	f
450	1455	1532	f
451	1456	1533	f
452	1456	1534	f
453	1459	1552	f
454	1460	1552	f
455	1461	1553	f
456	1462	1553	f
457	1475	1554	f
458	1475	1555	f
459	1476	1556	f
460	1476	1557	f
461	1479	1575	f
462	1480	1575	f
463	1481	1576	f
464	1482	1576	f
465	1495	1577	f
466	1495	1578	f
467	1496	1579	f
468	1496	1580	f
469	1499	1598	f
470	1500	1598	f
471	1501	1599	f
472	1502	1599	f
473	1515	1600	f
474	1515	1601	f
475	1516	1602	f
476	1516	1603	f
477	1519	1621	f
478	1520	1621	f
479	1521	1622	f
480	1522	1622	f
481	1535	1623	f
482	1535	1624	f
483	1536	1625	f
484	1536	1626	f
485	1539	1644	f
486	1540	1644	f
487	1541	1645	f
488	1542	1645	f
489	1555	1646	f
490	1555	1647	f
491	1556	1648	f
492	1556	1649	f
493	1559	1667	f
494	1560	1667	f
495	1561	1668	f
496	1562	1668	f
497	1575	1669	f
498	1575	1670	f
499	1576	1671	f
500	1576	1672	f
501	1579	1690	f
502	1580	1690	f
503	1581	1691	f
504	1582	1691	f
505	1595	1692	f
506	1595	1693	f
507	1596	1694	f
508	1596	1695	f
509	1599	1713	f
510	1600	1713	f
511	1601	1714	f
512	1602	1714	f
513	1615	1715	f
514	1615	1716	f
515	1616	1717	f
516	1616	1718	f
517	1619	1736	f
518	1620	1736	f
519	1621	1737	f
520	1622	1737	f
521	1635	1738	f
522	1635	1739	f
523	1636	1740	f
524	1636	1741	f
525	1639	1759	f
526	1640	1759	f
527	1641	1760	f
528	1642	1760	f
529	1655	1761	f
530	1655	1762	f
531	1656	1763	f
532	1656	1764	f
533	1659	1782	f
534	1660	1782	f
535	1661	1783	f
536	1662	1783	f
537	1675	1784	f
538	1675	1785	f
539	1676	1786	f
540	1676	1787	f
541	1679	1805	f
542	1680	1805	f
543	1681	1806	f
544	1682	1806	f
545	1695	1807	f
546	1695	1808	f
547	1696	1809	f
548	1696	1810	f
549	1699	1828	f
550	1700	1828	f
551	1701	1829	f
552	1702	1829	f
553	1715	1830	f
554	1715	1831	f
555	1716	1832	f
556	1716	1833	f
557	1719	1851	f
558	1720	1851	f
559	1721	1852	f
560	1722	1852	f
561	1735	1853	f
562	1735	1854	f
563	1736	1855	f
564	1736	1856	f
565	1739	1874	f
566	1740	1874	f
567	1741	1875	f
568	1742	1875	f
\.


--
-- Name: brands_stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('brands_stores_id_seq', 568, true);


--
-- Data for Name: stores; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY stores (id, store) FROM stdin;
\.


--
-- Name: stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('stores_id_seq', 1875, true);


--
-- Name: brands_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY brands
    ADD CONSTRAINT brands_pkey PRIMARY KEY (id);


--
-- Name: brands_stores_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY brands_stores
    ADD CONSTRAINT brands_stores_pkey PRIMARY KEY (id);


--
-- Name: stores_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY stores
    ADD CONSTRAINT stores_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: epicodus
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM epicodus;
GRANT ALL ON SCHEMA public TO epicodus;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

