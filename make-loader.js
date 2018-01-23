const fs = require('fs-extra'),
    collect = require('collect.js');


const rootPath = __dirname + '/resources/assets/js',
    fileNameExp = /\.vue$/,
    exceptDir = collect(['3rd','form','chart','common','data','button','layout','special']),
    nameExp = /\s+name:[\s'"]+([-\w]+)[\s"',]+/i,
    targetPath = __dirname + '/resources/assets/js/modules';

class MakeLoader {

    constructor() {
        this.files = [];
    }

    loadAll() {
        this.files = this.scanDir(rootPath);
    }

    output() {
        let template = "let AllVueComponents = { \n",
            targetFile = targetPath + '/make-loader-map.js';

        this.files.forEach(function (item) {
            let name = item[0], path = item[1];
            template += "\"" + name + "\": () => import(/* webpackChunkName: \""+name+"\" */ \""+path+"\"), \n";
        });

        template += "};\n";
        template += "export default AllVueComponents;";
        fs.ensureFile(targetFile);
        fs.writeFileSync(targetFile,template,'utf-8');
    }

    /**
     * 递归查找目录
     * @param path
     * @returns {Array}
     */
    scanDir(path) {
        let files = fs.readdirSync(path),
            self = this,
            filitedFiles = [];

        files.forEach(function (item) {
            let currentPath = path + '/' +item;

            if (fs.pathExistsSync(currentPath)) {
                let stat = fs.statSync(currentPath);

                //如果是目录，则继续递归
                if (stat.isDirectory() && !exceptDir.has(item) !== -1) {
                    filitedFiles = filitedFiles.concat(self.scanDir(currentPath));
                } else if (fileNameExp.test(item)) {

                    let content = fs.readFileSync(currentPath, 'utf-8'),
                        r = nameExp.exec(content);

                    if (r && r.length > 1) {
                        filitedFiles.push([r[1], currentPath]);
                    }
                }
            }
        });

        return filitedFiles;
    }
}

let makeLoader = new MakeLoader();
makeLoader.loadAll();
makeLoader.output();

