import os


class createLaravelProject:
    laravelCommand = "laravel new "

    def __init__(self, projectName, path):
        self.path = str(path)
        self.laravelCommand += str(projectName)

    def create(self):
        return os.system("cd "+self.path + " && "+self.laravelCommand)

    def getProjectPath(self):
        return self.path
