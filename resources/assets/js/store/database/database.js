
const DatabaseName = 'paladin';

export default class Database {
    static setIndexedDB(indexedDB) {
        Database.indexedDB = indexedDB;
    }

    static open() {
        return new Promise((resolve,reject) => {
            let request = Database.indexedDB.open(DatabaseName,1);
            request.onerror = (event) => {
                console.error('Cannot open IndexedDB',event);
                reject(event);
            };
            request.onupgradeneeded = (event) => {
                let db = event.target.result;

                for (let table of Database.tables) {

                    if (!db.objectStoreNames.contains(table.name)) {
                        db.createObjectStore(table.name, {keyPath: table.idKey});
                        console.log('created store object: ' + table.name);
                    }
                }
            };
            request.onsuccess = (event) => {
                Database.instace = event.target.result;
                resolve(event.target.result);
                console.log('open IndexedDB successfully');
            };
        });
    }

    static registerTable(tableName,idKey) {
        if (!_.isSet(Database.tables)) {
            Database.tables = new Set();
        }

        Database.tables.add({
            name: tableName,
            idKey: idKey
        });
    }

    static getDB() {
        return new Promise(resolve => {
            if (Database.instace) {
                resolve(Database.instace);
            } else {
                Database.open().then(db => {
                    resolve(db);
                })
            }
        })
    }

    static get(tableName,id) {
        return new Promise((resolve,reject) => {
            Database.getDB().then(db => {
                let transaction = db.transaction(tableName,['readonly']);
                let objectStore = transaction.objectStore(tableName);
                let request = objectStore.get(id);
                request.onsuccess = (event) => {
                    resolve(event.target.result);
                };
                request.onerror = (event) => {
                    reject(event);
                };
            });
        });
    }

    static put(tableName,items) {
        let success = [];
        if (!_.isArray(items)) {
            items = [items];
        }

        return new Promise((resolve,reject) => {
            Database.getDB().then(db => {
                let transaction = db.transaction(tableName,['readwrite']);
                let objectStore = transaction.objectStore(tableName);

                for (let item of items ) {
                    let request = objectStore.put(item);
                    request.onsuccess = (event) => {
                        if (success.length >= items.lenght) {
                            resolve(success);
                        } else {
                            success.push(event.target.result);
                        }
                    };
                    request.onerror = (event) => {
                        reject(event);
                    };
                }
            });
        });
    }

    static delete(tableName,id) {
        return new Promise((resolve,reject) => {
            Database.getDB().then(db => {
                let transaction = db.transaction(tableName,['readwrite']);
                let objectStore = transaction.objectStore(tableName);
                let request = objectStore.delete(id);
                request.onsuccess = (event) => {
                    resolve(event.target.result);
                };
                request.onerror = (event) => {
                    reject(event);
                };
            });
        });
    }

     static isOpened() {
        return !!Database.instance;
    }

    static close() {
        Database.instance.close();
    }
}

Database.tables = [];