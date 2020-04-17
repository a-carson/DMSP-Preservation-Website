// Read JSON javascript
// Essentials +++++++++++++++++++++++++++++++++++
const fs = require('fs');

function jsonReader(filePath, cb) {
    fs.readFile(filePath, (err, fileData) => {
        if (err) {
            return cb && cb(err)
        }
        try {
            const object = JSON.parse(fileData)
            return cb && cb(null, object)
        } catch (err) {
            return cb && cb(err)
        }
    })
}
//++++++++++++++++++++++++++++++++++++++++++++++++


var memoriesArray = [0, 0];


jsonReader('../json/memories.json', (err, memoriesJSON) => {
    if (err) {
        console.log(err)
        return
    }

    // get JSON contents
    memoriesArray = memoriesJSON;

    // Do something with the data ->
    for (var i = 0; i < memoriesArray.length; i++) {
        console.log(memoriesArray[i]);
    }
})
