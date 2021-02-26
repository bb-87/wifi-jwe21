// Klassen werden üblicherweise groß geschrieben
/**
 * A class for data structures that contain a list internally
 */
class List { // List ist "Ober-Klasse"
    constructor(name, seperator) {
        this._name = name;
        if (seperator === undefined) {
            this._seperator = ', ';
        } else {
            this._seperator = seperator; // _ für interne Variablen
        }
        this._list = [];
    }

    toString() {
        return this._name + ': ' + this._list.join(this._seperator);
    }
}

class Queue extends List { // List wird durch Queue erweitert
    constructor(name, seperator) {
        super(name, seperator); // super gibt name und seperator an Klasse List weiter
    }

    enqueue(element) {
        this._list.push(element);
    }

    dequeue() {
        return this._list.shift();
    }

    /**
     * @returns Returns the name and content of this queue
     */
    toString() {
        return super.toString();
    }
}

class Stack extends List{
    constructor(name, seperator) {
        super(name, seperator);
    }

    push(element) {
        this._list.push(element);
    }
    
    pop() {
        return this._list.pop();
    }

    /**
     * @returns Returns the name and content of this stack
     */
    toString() {
        return super.toString();
    }
}