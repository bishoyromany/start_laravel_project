import os


class createLaravelProject:

    basicCommands = {
        "laravel": {
            "name": "Installing Laravel....",
            "command": "laravel new ",
            "path": "root",
            "setting": "",
        },
        "laravelUI": {
            "name": "Installing Laravel UI....",
            "command": "composer require laravel/ui",
            "path": "project",
            "setting": "",
        },
        "vueUI": {
            "name": "Installing Vue UI....",
            "command": "php artisan ui vue",
            "path": "project",
            "setting": "",
        },
        "vueUIAuth": {
            "name": "Installing Vue UI Auth....",
            "command": "php artisan ui vue --auth",
            "path": "project",
            "setting": "",
        },
        "npm": {
            "name": "Installing NPM....",
            "command": "npm install",
            "path": "project",
            "setting": "",
        },
    }

    def __init__(self, projectSettings):

        self.rootPath = projectSettings['projectPath']['value']
        self.projectPath = projectSettings['projectPath']['value'] + \
            projectSettings['projectName']['value']

        self.basicCommands['laravel']['command'] += str(
            projectSettings['projectName']['value'])

    def create(self):
        for command in self.basicCommands.values():
            if len(command['setting']) > 0:
                pass

            commandPath = self.rootPath if command['path'] == 'root' else self.projectPath
            print(os.system("cd " + commandPath + " && " + command['command']))

    def getProjectPath(self):
        return self.projectPath
