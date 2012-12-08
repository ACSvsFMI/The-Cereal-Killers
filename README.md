The-Cereal-Killers
==================

"Occupy Bucharest" este o aplicatie care determina pozitia pe harta Bucurestiului unde se vor aseza cele 100 de familii 
care doresc sa se mute. Algoritmul incearca sa tina cont de preferintele familiilor.

Interfata aplicatiei permite introducerea datelor in format JSON. Acestea sunt trimise unui script php care proceseaza datele
si returneaza, conform cerintei, o cat mai buna configuratie de locatii specificate prin coordonatele lor geografice si
o lista cu familiile care nu au putut fi plasate. Preferintele acestora pot fi modificate iar datele trimise din nou.
Raspunsul scriptului va fi prelucrat de codul jQuery care il va afisa pe harta Google Maps.

