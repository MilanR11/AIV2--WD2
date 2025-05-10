  function updateTime() {
        var now = new Date(); // Získaj aktuálny dátum a čas
        var hours = now.getHours().toString().padStart(2, '0'); // Získaj hodiny
        var minutes = now.getMinutes().toString().padStart(2, '0'); // Získaj minúty
        var seconds = now.getSeconds().toString().padStart(2, '0'); // Získaj sekundy

        // Zobraz aktuálny čas v požadovanom formáte
        document.getElementById("clock").innerText = hours + ":" + minutes + ":" + seconds;
    }

    // Aktualizuj čas každú sekundu
    setInterval(updateTime, 1000);

    // Zavolaj funkciu pri načítaní stránky
    updateTime();