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
    # default answer for Yes or No
    defaultYesOrNoAnswer = 'n'

    def __init__(self):
        self.projectSettings = {
            "projectName": {
                'value': "example_project",
                'input': "Project Name ? [leave empty for default name] \n",
                'validate': "path",
            },
            "projectPath": {
                'value': self.currentPath,
                'input': "Project Path ? [Current Path]\n",
                'validate': "path",
            },
            "adminPermissions": {
                'value': self.defaultYesOrNoAnswer,
                'input': "Add Admin Permissions ? {yesOrNo} [{value}]\n".format(yesOrNo=self.inputYesOrNo, value=self.defaultYesOrNoAnswer),
            },
            "adminDashboard": {
                'value': self.defaultYesOrNoAnswer,
                'input': "Add Admin Dashboard ? {yesOrNo} [{value}]\n".format(yesOrNo=self.inputYesOrNo, value=self.defaultYesOrNoAnswer),
            },
            "guzzle": {
                'value': self.defaultYesOrNoAnswer,
                'input': "Add Guzzle ? {yesOrNo} [{value}]\n".format(yesOrNo=self.inputYesOrNo, value=self.defaultYesOrNoAnswer),
            },
            "JWTAuth": {
                'value': self.defaultYesOrNoAnswer,
                'input': "Add JWT Auth And API ? {yesOrNo} [{value}]\n".format(yesOrNo=self.inputYesOrNo, value=self.defaultYesOrNoAnswer),
            },
            "LaravelIDEHelper": {
                'value': self.defaultYesOrNoAnswer,
                'input': "Add Laravel IDE Helper ? {yesOrNo} [{value}]\n".format(yesOrNo=self.inputYesOrNo, value=self.defaultYesOrNoAnswer),
            },
            "PowerfullWebpack": {
                'value': self.defaultYesOrNoAnswer,
                'input': "Edit Webpack To Have Live Reload, Pug And SASS ? {yesOrNo} [{value}]\n".format(yesOrNo=self.inputYesOrNo, value=self.defaultYesOrNoAnswer),
            },
            "ControllerStructure": {
                'value': self.defaultYesOrNoAnswer,
                'input': "Add Controller Sample File ? {yesOrNo} [{value}]\n".format(yesOrNo=self.inputYesOrNo, value=self.defaultYesOrNoAnswer),
            },
            "viewStructure": {
                'value': self.defaultYesOrNoAnswer,
                'input': "Add View Sample File ? {yesOrNo} [{value}]\n".format(yesOrNo=self.inputYesOrNo, value=self.defaultYesOrNoAnswer),
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

    def validateInput(self, inputValue, validateType):
        if validateType == self.defaultInputValidate:
            return inputValue in self.allowedProjectSettingsResponse
        elif validateType == 'path':
            return True
        return False

    def getProjectSettings(self):
        return self.projectSettings
