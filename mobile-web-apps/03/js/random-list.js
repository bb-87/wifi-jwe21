function randomInt(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
}

/**
 * A class for a list of random integer elements
 */

class RandomList {
    /**
     * Creates a new list of random integers
     * 
     * @param {Number} min Minimum integer
     * @param {Number} max Maximum integer
     * @param {Number} length Number of elements in the list
     */
    constructor(min, max, length) {
        this._list = [];
        // // Option 3: Zusätzliches Erzeugen eines Sets
        // this._set = new Set(); // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Set/Set

        // Option 4: 
        this._map = new Map();

        for (let i = 0; i < length; i++) {
            const randomNumber = randomInt(min, max);

            this._list.push(randomNumber);
            // Option 3: Set updaten
            // this._set.add(randomNumber);

            // Option 4: Map updaten
            if (this._map.has(randomNumber)) {
                const cnt = this._map.get(randomNumber);
                this._map.set(randomNumber, cnt + 1);
            } else {
                this._map.set(randomNumber, 1);
            }
        }

        // // Option 2: Sortieren der Liste
        // this._list.sort(function compare(a, b) {
        //     return a - b; // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/sort#description
        // });
    }

    /**
     * Checks if a given value is in the list
     * @param {Number} val 
     */
    isInList(val) {
        // // Option 1: Suchen in der Liste nach einem Wert
        // for (let i = 0; i < this._list.length; i++) {
        //     if (this._list[i] === val) {
        //         return true;
        //     }
        //     // Option 2: Abbrechen, wenn der Wert in einer geordneten Liste nicht mehr gefunden werden kann 
        //     else if (this._list[i] > val) {
        //         return false;
        //     }
        // }
        // return false;

        // // Option 3: Nutzen von Set
        // // set.has() returns true or false
        // return this._set.has(val); 

        // Option 4: Nutzen von Map. Wenn val kein Schlüssel in der Map ist, kommt value nicht vor.
        return this._map.has(val);
    }

    /**
     * Find the number of occurences of a given value in the list
     * @param {Number} val 
     * @returns {Number} The number of occurences
     */
    count(val) {
        // // Option 1: Durchsuchen der Liste 
        // let cnt = 0;

        // for (let i = 0; i < this._list.length; i++) {
        //     if (this._list[i] === val) {
        //         cnt++;
        //     } else if (this._list[i] > val) {
        //         return cnt;
        //     }
        // }
        // return cnt;

        // Option 2: Nutzen von Map
        return this._map.get(val);
    }
}