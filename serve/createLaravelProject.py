import shutil
import os


class createLaravelProject:

    basicCommands = {
        # "laravel": {
        #     "name": "Installing Laravel....",
        #     "command": "laravel new ",
        #     "path": "root",
        #     "setting": "",
        # },
        # "laravelUI": {
        #     "name": "Installing Laravel UI....",
        #     "command": "composer require laravel/ui",
        #     "path": "project",
        #     "setting": "",
        # },
        # "vueUI": {
        #     "name": "Installing Vue UI....",
        #     "command": "php artisan ui vue",
        #     "path": "project",
        #     "setting": "",
        # },
        # "vueUIAuth": {
        #     "name": "Installing Vue UI Auth....",
        #     "command": "php artisan ui vue --auth",
        #     "path": "project",
        #     "setting": "",
        # },
        # "npm": {
        #     "name": "Installing NPM....",
        #     "command": "npm install",
        #     "path": "project",
        #     "setting": "",
        # },
        # "laravelIDEHelperInstall": {
        #     "name": "Installing Laravel IDE Helper....",
        #     "command": "composer require --dev barryvdh/laravel-ide-helper",
        #     "path": "project",
        #     "setting": "LaravelIDEHelper",
        # },
        # "laravelIDEHelperInstall": {
        #     "name": "Installing Laravel IDE Helper....",
        #     "command": "composer require --dev barryvdh/laravel-ide-helper && php artisan vendor:publish --provider=\"Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider\" --tag=config",
        #     "path": "project",
        #     "setting": "LaravelIDEHelper",
        #     "file": [
        #         {
        #             'from': "files/configs/",
        #             'fromFile': "AppServiceProvider.php",
        #             "to": "app/Providers/",
        #             "toFile": "AppServiceProvider.php",
        #             "type": "replace"
        #         }
        #     ]
        # },
        # "laravelIDEHelperConfig": {
        #     "name": "Installing Laravel IDE Config....",
        #     "command": "php artisan vendor:publish --provider=\"Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider\" --tag=config",
        #     "path": "project",
        #     "setting": "LaravelIDEHelper",
        #     "file": [
        #         {
        #             'from': "files/configs/",
        #             'fromFile': "AppServiceProvider.php",
        #             "to": "app/Providers/",
        #             "toFile": "AppServiceProvider.php",
        #             "type": "replace"
        #         }
        #     ]
        # },
        # "laravelIDEHelperGenerate": {
        #     "name": "Installing Laravel IDE Generate....",
        #     "command": "php artisan ide-helper:generate",
        #     "path": "project",
        #     "setting": "LaravelIDEHelper",
        # },
        # "PowerfullWebpack": {
        #     "name": "Updating Webpack....",
        #     "command": "npm install --only=dev node-sass && npm install --only=dev pug-plain-loader && npm install --only=dev raw-loader && npm install --only=dev webpack-livereload-plugin",
        #     "path": "project",
        #     "setting": "PowerfullWebpack",
        #     "file": [
        #         {
        #             'from': "files/configs/",
        #             'fromFile': "webpack.mix.js",
        #             "to": "",
        #             "toFile": "webpack.mix.js",
        #             "type": "replace"
        #         }
        #     ]
        # },
        # "guzzle": {
        #     "name": "Installing Guzzle....",
        #     "command": "composer require guzzlehttp/guzzle:^7.0",
        #     "path": "project",
        #     "setting": "guzzle",
        # },
        "adminPermissions": {
            "name": "Adding Admin Permissions....",
            "command": "",
            "path": "project",
            "setting": "adminPermissions",
            "file": [
                {
                    'from': "files/configs/",
                    'fromFile': "AdminPermissions.php",
                    "to": "app/Http/Middleware/",
                    "toFile": "Admin.php",
                    "type": "replace"
                },
                {
                    'from': "files/migrations/",
                    'fromFile': "usersPermissions.php",
                    "to": "database/migrations/",
                    "toFile": "2014_10_12_000000_create_users_table.php",
                    "type": "replace"
                },
                {
                    'from': "files/models/",
                    'fromFile': "UserPermissions.php",
                    "to": "app/",
                    "toFile": "User.php",
                    "type": "replace"
                },
            ]
        }


    }

    def __init__(self, projectSettings):
        self.projectSettings = projectSettings
        self.rootPath = projectSettings['projectPath']['value']
        self.projectPath = projectSettings['projectPath']['value'] + \
            projectSettings['projectName']['value']

        # self.basicCommands['laravel']['command'] += str(
        #     projectSettings['projectName']['value'])

    def create(self):
        for command in self.basicCommands.values():
            # check settigns
            if len(command['setting']) > 0:
                if self.projectSettings[command['setting']]['value'] == 'n':
                    continue
            # run command
            if len(command['command']) > 0:
                print(command['name'])
                commandPath = self.rootPath if command['path'] == 'root' else self.projectPath
                print(os.system("cd " + commandPath +
                                " && " + command['command']))
                print(
                    "_________________________________________________________________")
            # move the file
            if 'file' in command:
                for file in command['file']:
                    print(self.moveFile(
                        file['from'], file['fromFile'], file['to'], file['toFile'], file['type']))
                    print(
                        "_________________________________________________________________")

    def moveFile(self, old, oldFile, new, newFile, operationType):
        if operationType == 'replace':
            oldFilePath = os.path.join(self.rootPath, old, oldFile)
            newFilePath = os.path.join(self.projectPath, new, newFile)
            shutil.copyfile(oldFilePath, newFilePath)

        return "File " + newFile + " Moved To " + newFilePath

    def getProjectPath(self):
        return self.projectPath
