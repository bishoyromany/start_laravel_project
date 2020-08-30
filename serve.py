import serve.projectSettings as projectSettings
import serve.createLaravelProject as createLaravelProject

if __name__ == '__main__':
    # ? Get Project Settings
    projectSettingsObject = projectSettings.getProjectSettings()
    projectSettings = projectSettingsObject.getProjectSettings()

    # ? Start Creating The Project
    createLaravelProjectObject = createLaravelProject.createLaravelProject(
        projectSettings['projectName']['value'], projectSettings['projectPath']['value'])

    print(createLaravelProjectObject.create())

    projectSettingsObject.startInput()

    input("Press Enter To Close...")
