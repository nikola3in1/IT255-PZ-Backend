# IT255-PZ-Backend
Backend deo projektnog zadataka iz predmeta IT255.

Opis sistema

MusicBox predstavlja sistem koji korisnicima pruža mogućnost prodaje i kupovine audio materijala kao što su muzika,
džinglovi, bitovi, pozadinska muzika, zvučni efekti i slično.

U podesavanjima apache2 servera potrebno je podesiti 
upload_max_filesize = 40M
post_max_size = 40M

Takodje, neophodno je preuzeti getID3 php biblioteku za citanje ID3 taga (konkretno trajanja pesme) pesama uploadovanih na sistemu.
https://github.com/JamesHeinrich/getID3
