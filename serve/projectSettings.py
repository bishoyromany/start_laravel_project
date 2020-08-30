import os


class getProjectSettings:
    # yes or no variable for input
    inputYesOrNo = "[y/n] "
    # current path
    currentPath = os.path.dirname(os.path.abspath(__file__)) + '\\..\\'
    # expected response for yes or no input
    allowedProjectSettingsResponse = ['y', 'n']
    # default validate
    defaultInputValidate = "yesOrNo"
    # red color
    redColor = "\x1B["

    def __init__(self):
        self.projectSettings = {
            "projectName": {
                'value': "example_project",
                'input': "Project Name ? [leave empty for default name] ",
                'validate': "path",
            },
            "projectPath": {
                'value': self.currentPath,
                'input': "Project Path ? [leave empty for current path] ",
                'validate': "path",
            },
            "adminPermissions": {
                'value': 'n',
                'input': "Add Admin Permissions ? {yesOrNo}".format(yesOrNo=self.inputYesOrNo),
            },
            "adminDashboard": {
                'value': 'n',
                'input': "Add Admin Dashboard ? {yesOrNo}".format(yesOrNo=self.inputYesOrNo),
            },
            "guzzle": {
                'value': 'n',
                'input': "Add Guzzle ? {yesOrNo}".format(yesOrNo=self.inputYesOrNo),
            },
            "JWTAuth": {
                'value': 'n',
                'input': "Add JWT Auth And API ? {yesOrNo}".format(yesOrNo=self.inputYesOrNo),
            },
            "LaravelIDEHelper": {
                'value': 'y',
                'input': "Add Laravel IDE Helper ? {yesOrNo}".format(yesOrNo=self.inputYesOrNo),
            },
            "PowerfulWebpack": {
                'value': 'n',
                'input': "Edit Webpack To Have Live Reload, Pug And SASS ? {yesOrNo}".format(yesOrNo=self.inputYesOrNo),
            },
            "ControllerStructure": {
                'value': 'n',
                'input': "Add Controller Sample File ? {yesOrNo}".format(yesOrNo=self.inputYesOrNo),
            },
            "viewStructure": {
                'value': 'n',
                'input': "Add View Sample File ? {yesOrNo}".format(yesOrNo=self.inputYesOrNo),
            },
        }

    def startInput(self):
        for settingKey in self.projectSettings:
            setting = self.projectSettings[settingKey]
            userInput = str(input(setting['input']))
            validateType = setting['validate'] if 'validate' in setting.keys(
            ) else self.defaultInputValidate
            result = self.validateInput(userInput, validateType)
            if result and len(userInput) > 0:
                self.projectSettings[settingKey]['value'] = userInput
            elif validateType == 'path':
                continue
            else:
                print(
                    self.redColor+"31;40m" + "Make Sure To Write A Correct Input, Script Will Use The Default Value Which Is n" + self.redColor + "0m")

    def validateInput(self, inputValue, validateType):
        if validateType == self.defaultInputValidate:
            return inputValue in self.allowedProjectSettingsResponse
        elif validateType == 'path':
            return True
        return False

    def getProjectSettings(self):
        return self.projectSettings
